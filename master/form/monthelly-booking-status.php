<!DOCTYPE HTML>
<?php
require_once "../../core/php/con-no-watch.php";
?>
<html>
	<head>
            
<script type="text/javascript" src="../core/scripts/highcharts.js"></script>
<!--script type="text/javascript" src="../core/scripts/themes/gray.js"></script-->
<script type="text/javascript" src="../core/scripts/modules/exporting.js"></script>
		<script type="text/javascript">
		
			var chart;
			$(document).ready(function() {
				chart = new Highcharts.Chart({
					chart: {
						renderTo: 'container',
						defaultSeriesType: 'line'
					},
					title: {
						text: '<?php  
                                                $month = $_GET['mm'];
                                                $yy = $_GET['yy'];
                                                
                                                 if($month == "01"){
                                                    echo 'January';
                                                   
                                                }
                                                elseif($month == "02"){
                                                        echo 'February';
                                                }
                                                elseif($month == "03"){
                                                        echo 'March';
                                                }
                                                elseif($month == "04"){
                                                        echo 'April';
                                                }
                                                elseif($month == "05"){
                                                        echo 'May';
                                                }
                                                elseif($month == "06"){
                                                        echo 'June';
                                                }
                                                elseif($month == "07"){
                                                        echo 'July';
                                                }
                                                elseif($month == "08"){
                                                        echo 'August';
                                                }
                                                elseif($month == "09"){
                                                        echo 'September';
                                                }
                                                elseif($month == "10"){
                                                        echo 'October';
                                                }
                                                elseif($mm == "11"){
                                                        echo 'November';
                                                }
                                                elseif($mm == "12"){
                                                        echo 'December';
                                                }
                                                else{
                                                //do nithink
                                                }
                                            
                                            echo $yy;
                                            $daysP = cal_days_in_month(CAL_GREGORIAN, $month, $yy);
                                            ?>'
					},
					subtitle: {
						text: 'Total days in a month <?php  $days = $daysP+1; echo $daysP; ?>'
					},
					xAxis: {
						categories: [<?php for ($i=1; $i<$days;$i++){ echo "'".$i."', ";} ?>]
					},
					yAxis: {
						title: {
							text: 'Order Range'
						}
					},
					tooltip: {
						enabled: false,
						formatter: function() {
							return '<b>'+ this.series.name +'</b><br/>'+
								this.x +': '+ this.y +'°C';
						}
					},
					plotOptions: {
						line: {
							dataLabels: {
								enabled: true
							},
							enableMouseTracking: false
						}
					},
					series: [{
						name: 'Book',
						data: [<?php
                                                for($k=1;$k<$days;$k++){
                                                    if($k < 10){
                                                        $date =  $yy.'-'.$month.'-0'.$k;
                                                    }else{
                                                        $date = $yy.'-'.$month.'-'.$k;
                                                    }
                                                    //echo "SELECT * FROM `app_log` WHERE `al_log_type` = 'BOK' AND DATE_FORMAT(`al_date`, '%Y-%m-%d') = '$date'";
                                                $sqlBok = mysql_query("SELECT * FROM `app_log` WHERE `al_log_type` = 'BOK' AND DATE_FORMAT(`al_date`, '%Y-%m-%d') = '$date'");
                                                if(mysql_error()){
                                                    echo mysql_error();
                                                }
                                               echo $countBok = mysql_num_rows($sqlBok).', ';
                                                                                                }
                                                ?>]
					}, {
						name: 'Canceled',
						data: [<?php
                                                for($m=1;$m<$days;$m++){
                                                    if($m < 10){
                                                        $datem = $yy.'-'.$month.'-0'.$m;
                                                    }else{
                                                        $datem = $yy.'-'.$month.'-'.$m;
                                                    }
                                                    //echo "SELECT * FROM `app_log` WHERE `al_log_type` = 'BOK' AND DATE_FORMAT(`al_date`, '%Y-%m-%d') = '$date'";
                                                $sqlCel = mysql_query("SELECT * FROM `app_log` WHERE `al_log_type` = 'CEL' AND DATE_FORMAT(`al_date`, '%Y-%m-%d') = '$datem'");
                                                if(mysql_error()){
                                                    echo mysql_error();
                                                }
                                               echo $countCel = mysql_num_rows($sqlCel).', ';
                                                                                                }
                                                ?>]
					}, {
						name: 'Dispatch',
						data: [<?php
                                                for($n=1;$n<$days;$n++){
                                                    if($n < 10){
                                                        $daten = $yy.'-'.$month.'-0'.$n;
                                                    }else{
                                                        $daten = $yy.'-'.$month.'-'.$n;
                                                    }
                                                    //echo "SELECT * FROM `app_log` WHERE `al_log_type` = 'BOK' AND DATE_FORMAT(`al_date`, '%Y-%m-%d') = '$date'";
                                                $sqlDis = mysql_query("SELECT * FROM `app_log` WHERE `al_log_type` = 'DIS' AND DATE_FORMAT(`al_date`, '%Y-%m-%d') = '$daten'");
                                                if(mysql_error()){
                                                    echo mysql_error();
                                                }
                                               echo $countDis = mysql_num_rows($sqlDis).', ';
                                                                                                }
                                                ?>]
					}
                                    ]
				});
				
				
			});
				
		</script>
		
	</head>
	<body>
		
		<!-- 3. Add the container -->
        <table  width="100%" border="0" id="product-table">
            <tr>
                <th class="table-header-repeat">
                    &nbsp;
                </th>
            </tr>
            <tr>
                <td colspan="2" align="center" valign="top">
                   <div id="container" style="width: 100%; height: 600px; margin: 0 auto;border:none;"></div> 
                </td>
            </tr>
            <tr>
                <th class="table-header-repeat">
                    &nbsp;
                </th>
            </tr>
        </table>
                
                
		
			
	</body>
</html>
