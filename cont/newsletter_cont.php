<?php
    if(isset($_POST['nlmail']) && isset($_POST['nlsubmit'])){
        $regEmail = "/^\w+([\.\-]?\w+)*\@\w+([\.\-]?\w+)*(\.\w{2,3})+$/";

        include('msg.php');

        if(preg_match($regEmail,$_POST['nlmail'])){
            
            include("dbconnection.php");
            $query = sprintf("SELECT unsub FROM newsletter WHERE email='%s'",$_POST['nlmail']);
            $result = mysql_query($query,$connect);
            
            if(mysql_num_rows($result) ==0){
                
                $query = sprintf("INSERT INTO newsletter VALUES('','%s',0)",$_POST['nlmail']);
                $result = mysql_query($query,$connect);
                if($result){
                    success("Thanks for subscribing to My socks newsletter.");
                }
            }
            else{
                $unsub = mysql_fetch_array($result);
                if($unsub['unsub'] == 1){
                    $query = sprintf("UPDATE newsletter SET unsub = 0 WHERE email='%s'",$_POST['nlmail']);
                    $result = mysql_query($query,$connect);
                    if($result){
                        success("Thanks for subscribing to My socks newsletter.");
                    }
                }
            }
            mysql_close($connect);
        }
        else{
            error('Email must be valid.');
        }
    }
?>