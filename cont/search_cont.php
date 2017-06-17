<?php
    if(isset($_REQUEST['searchtext'])){
        if(preg_match("/^[\w\d\s]+$/",$_REQUEST['searchtext'])){
            header('Location: ../index.php?page=11&searchtext='.$_REQUEST['searchtext']);
        }
        else{
            header('Location: ../index.php');
        }
    }else{
        header('Location: ../index.php');
    }
?>