 <script type="text/javascript">
    $(function() {
        $('#gallery a').lightBox();
    });
    </script>
   	<style type="text/css">
	/* jQuery lightBox plugin - Gallery style */
	#gallery {
		background-color:#008AFF;
		padding: 10px;
		width: 98%;
	}
	#gallery ul { list-style: none; }
	#gallery ul li { display: inline; }
	#gallery ul img {
		border: 5px solid #008AFF;
		border-width: 5px 5px 20px;
	}
	#gallery ul a:hover img {
		border: 5px solid #fff;
		border-width: 5px 5px 20px;
		color: #fff;
	}
	#gallery ul a:hover { color: #fff; }
	</style>
<?php
require_once "../../core/php/connection.php";
$id = $_GET['id'];
$sqlCab = mysql_query("SELECT * FROM `cab_images` WHERE `ci_code` = (SELECT cab_code FROM cabs WHERE cab_id = '$id')");
if(mysql_error()){
	echo '<div class="error_main"><img src="images/001_11.png" width="24" height="24"><br><b>Cannot load images!!</b></div>';
}else{
	$roCab = mysql_fetch_assoc($sqlCab);
        $fv = $roCab['ci_front_image'];
        if($fv == ""){
            $fvImg = 'images/default_cab.png';
        }else{
            $fvImg = $fv;
        }
        $bv = $roCab['ci_back_image'];
        if($bv == ""){
            $bvImg = 'images/default_cab.png';
        }else{
            $bvImg = $bv;
        }
        
        $lv = $roCab['ci_left_image'];
        if($lv == ""){
            $lvImg = 'images/default_cab.png';
        }else{
            $lvImg = $lv;
        }
        
        $rv = $roCab['ci_right_image'];
        if($rv == ""){
            $rvImg = 'images/default_cab.png';
        }else{
            $rvImg = $rv;
        }
        $ifv = $roCab['ci_interior_front_image'];
        if($ifv == ""){
            $ifImg = 'images/default_cab.png';
        }else{
            $ifImg = $ifv;
        }
        $ibv = $roCab['ci_interior_back_image'];
        if($ibv == ""){
            $ibImg = 'images/default_cab.png';
        }else{
            $ibImg = $ibv;
        }
	?>
   <div id="gallery">
    <ul>
        <li>
            <a href="<?php echo $fvImg; ?>" title="FRONT VIEW.">
                <img src="<?php echo $fvImg; ?>" width="155" height="150" alt="" />
            </a>
        </li>
        <li>
            <a href="<?php echo $bvImg; ?>" title="BACK VIEW.">
                <img src="<?php echo $bvImg; ?>" width="155" height="150" alt="" />
            </a>
        </li>
        <li>
            <a href="<?php echo $lvImg; ?>" title="Left View.">
                <img src="<?php echo $lvImg; ?>" width="155" height="150" alt="" />
            </a>
        </li>
        <li>
            <a href="<?php echo $rvImg; ?>" title="Right View.">
                <img src="<?php echo $rvImg; ?>" width="155" height="150" alt="" />
            </a>
        </li>
        <li>
            <a href="<?php echo $ifImg; ?>" title="Interior Front View.">
                <img src="<?php echo $ifImg; ?>" width="155" height="150" alt="" />
            </a>
        </li>
        <li>
            <a href="<?php echo $ibImg; ?>" title="Interior Back View.">
                <img src="<?php echo $ibImg; ?>" width="155" height="150" alt="" />
            </a>
        </li>
    </ul>
</div>
    <?php
}
?>