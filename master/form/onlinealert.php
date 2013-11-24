 <div class="onlineorders">
        
        <div class="showonlineorder">
            <?php
            //$date = date("Y-m-d");
            require_once "../../core/php/connection.php";
            $date = date("Y-m-d");
             $sqlOnl = mysql_query("SELECT booking_code,booking_id FROM `online_record` WHERE  `status` = '1'");
             $countOnl = mysql_num_rows($sqlOnl);
             if(mysql_error()){
                 echo mysql_error();
             }
             if($countOnl != 0){
                 echo '<div class="title">ONLINE ORDER</div><ul>';
                 while($rowsOnl = mysql_fetch_assoc($sqlOnl)){
                     echo '<li><a href="#" id="../master/form/confirm-order.php?id='.$rowsOnl['booking_id'].'" onClick="showMainAction(this.id)">'.$rowsOnl['booking_code'].'</a></li>';
                 }
                 echo '</ul>';
             }
            ?>
        </div>
    </div>