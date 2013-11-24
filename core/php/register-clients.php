<?php
    /*require("connection.php");
    $operation = $_GET['op'];
    $client = $_SERVER['REMOTE_ADDR'];
    if($operation=='REG'){
        //check if this client is already registered
        $isReged = mysql_query("SELECT registration_token FROM registered_clients WHERE remote_addr='$client'");
        if(mysql_num_rows($isReged)==0){
            $sqlClient = mysql_query("SELECT max(registration_token) regToken FROM registered_clients");
            $rowClients = mysql_fetch_assoc($sqlClient);
            $numClients = $rowClients['regToken'];
            $numClients = $numClients+1;
            $sqlRegister = mysql_query("INSERT INTO registered_clients (remote_addr,registration_token) VALUES ('$client',$numClients)");
            echo $numClients;
        }else{
            $res = mysql_fetch_assoc($isReged);
            echo $res['registration_token'];
        }
    }
    else{
        $sqlUnReg = mysql_query("DELETE FROM registered_clients WHERE remote_addr = '$client'");
        if(mysql_error()){
            echo "Unable to unregister client";
        }
        else{
            echo "Done";
        }
    }
    mysql_close();*/
?>
