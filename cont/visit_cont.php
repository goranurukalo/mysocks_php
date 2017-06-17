<?php
    if(!isset($_COOKIE['uservisit'])){
        include('dbconnection.php');
        $query = sprintf("INSERT INTO visit VALUES('',%d)",mktime());
        $result = mysql_query($query,$connect);
        if($result){
            setcookie('uservisit', 'value', time() + 86400, "/");
            //setcookie('uservisit', 'value', time() + 60, "/");
        }
    }
?>