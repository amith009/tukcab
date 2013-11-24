<?php
require('../../core/php/fpdf.php');

class PDF extends FPDF
{
var $B;
var $I;
var $U;
var $HREF;

function PDF($orientation='P', $unit='mm', $size='A4')
{
    // Call parent constructor
    $this->FPDF($orientation,$unit,$size);
    // Initialization
    $this->B = 0;
    $this->I = 0;
    $this->U = 0;
    $this->HREF = '';
}

function WriteHTML($html)
{
    // HTML parser
    $html = str_replace("\n",' ',$html);
    $a = preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
    foreach($a as $i=>$e)
    {
        if($i%2==0)
        {
            // Text
            if($this->HREF)
                $this->PutLink($this->HREF,$e);
            else
                $this->Write(5,$e);
        }
        else
        {
            // Tag
            if($e[0]=='/')
                $this->CloseTag(strtoupper(substr($e,1)));
            else
            {
                // Extract attributes
                $a2 = explode(' ',$e);
                $tag = strtoupper(array_shift($a2));
                $attr = array();
                foreach($a2 as $v)
                {
                    if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
                        $attr[strtoupper($a3[1])] = $a3[2];
                }
                $this->OpenTag($tag,$attr);
            }
        }
    }
}

function OpenTag($tag, $attr)
{
    // Opening tag
    if($tag=='B' || $tag=='I' || $tag=='U')
        $this->SetStyle($tag,true);
    if($tag=='A')
        $this->HREF = $attr['HREF'];
    if($tag=='BR')
        $this->Ln(5);
}

function CloseTag($tag)
{
    // Closing tag
    if($tag=='B' || $tag=='I' || $tag=='U')
        $this->SetStyle($tag,false);
    if($tag=='A')
        $this->HREF = '';
}

function SetStyle($tag, $enable)
{
    // Modify style and select corresponding font
    $this->$tag += ($enable ? 1 : -1);
    $style = '';
    foreach(array('B', 'I', 'U') as $s)
    {
        if($this->$s>0)
            $style .= $s;
    }
    $this->SetFont('',$style);
}

function PutLink($URL, $txt)
{
    // Put a hyperlink
    $this->SetTextColor(0,0,255);
    $this->SetStyle('U',true);
    $this->Write(5,$txt,$URL);
    $this->SetStyle('U',false);
    $this->SetTextColor(0);
}
function Header()
{
    // Logo
    $this->Image('../../core/images/bill_header_pdf.png',0,2,207);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Move to the right
    $this->Cell(80);
    // Title
    $this->Cell(10,70,'EMPLOYEES DETAILS',0,0,'C');
    // Line break
    $this->Ln(50);
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

/*Drivers details*/
require_once "../../core/php/connection.php";
 $did = $_GET['id'];
 if($did == 0){
     	 $html = '<table><tr><td>Record Not Found</td></tr></table>';
 }else{
 $sqlDri = mysql_query("SELECT * FROM `employee` WHERE `emp_id` = '$did'");
 if(mysql_error()){
	 $html = '<table><tr><td>Record Not Found</td></tr></table>';
 }else{
	 $rodr = mysql_fetch_assoc($sqlDri);
       $oen = $rodr['driver_type'];
/** variable call*/
	$acs = $rows['access_level'];
       $sqlAcce = mysql_query("SELECT * FROM `access_level` WHERE `access_id` = '$acs'");
       if(mysql_error()){
			$attype = "N/A";
       }else{
           $rowsEmp = mysql_fetch_assoc($sqlAcce);
           $attype = $rowsEmp['access_type'];
       }

$html .= '<div class="rows"><b>Name:</b> '.$rodr['emp_name'].'</div><br />';
$html .= '<div class="rows"><b>Date of birth:</b> '.$rodr['dob'].'</div><br />';
$html .= '<div class="rows"><b>Attching Type:</b> '.$attype.'</div><br />';
$html .= '<div class="rows"><b>Date of joining:</b> '.$rodr['doj'].'</div><br />';
$html .= '<div class="rows"><b>Mobile No:</b> '.$rodr['mobile_no'].'</div><br />';
$html .= '<div class="rows"><b>Alternet Mobile No:</b> '.$rodr['alt_number'].'</div><br />';
$html .= '<div class="rows"><b>Phone No:</b> '.$rodr['ph_number'].'</div><br />';
$html .= '<div class="rows"><b>E-mail address:</b> '.$rodr['email'].'</div><br />';
$html .= '<div class="rows"><b>Alternet E-mail address:</b> '.$rodr['alt_email'].'</div><br /><br />';
$html .= '<div class="rows"><b>Address Line 1:</b> '.$rodr['emp_add1'].'</div><br />';
$html .= '<div class="rows"><b>Address Line 2:</b> '.$rodr['emp_add2'].'</div><br />';
$html .= '<div class="rows"><b>City:</b> '.$rodr['city'].'</div><br />';
$html .= '<div class="rows"><b>State:</b> '.$rodr['state'].'</div><br />';
$html .= '<div class="rows"><b>Country:</b> '.$rodr['country'].'</div><br />';
$html .= '<div class="rows"><b>PIN Code:</b> '.$rodr['zip'].'</div><br />';


$pdf = new PDF();

$pdf->AddPage();
$pdf->SetFont('Times','',12);
$pdf->SetFont('');
$pdf->SetLink($link);
$pdf->Image('../../core/'.$rodr['emp_img_content'],7,60,50,0,'','http://www.kkcabs.com');
$pdf->SetLeftMargin(60);
$pdf->SetFontSize(12);
$pdf->WriteHTML($html);
$pdf->Output();
}
}
?>