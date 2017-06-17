<?php
    if(isset($_POST['unsubemail']) && isset($_POST['unsubsubmit'])){
        $regEmail = "/^\w+([\.\-]?\w+)*\@\w+([\.\-]?\w+)*(\.\w{2,3})+$/";

        if(preg_match($regEmail,$_POST['unsubemail'])){
            include("dbconnection.php");
            $query = sprintf("UPDATE newsletter SET unsub = 1 WHERE email='%s'",$_POST['unsubemail']);
            $result = mysql_query($query,$connect);

            if($result){
                echo" unsub se";
            }

            mysql_close($connect);
        }else{
            include('msg.php');
            error('Email must be valid.');
        }
    }
?>

<div class="logintext">My socks</div>
<div class="loginline"></div>
<div class="loginlinetext unsublinetext">Unsubscribe</div>

<div class="loginform">
    <form action="<?php echo $_SERVER['PHP_SELF']?>" method='POST' id='unsubform' onsubmit="return unsubscribemail();">
        <input type='hidden' name='page' value='7'>
        <input type="text" name='unsubemail' id='unsubemail' placeholder='E-MAIL' oninput="setCustomValidity('');">

        <input type='submit' name='unsubsubmit' id='unsubsubmit' value='UNSUBSCRIBE'>
    </form>
</div>