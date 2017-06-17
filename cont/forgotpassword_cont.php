<?php
    if(isset($_SESSION['role'])){
        header('Location: index.php');
    }
    else{
        if(isset($_POST['unsubsubmit'])){
            include('msg.php');
            if(isset($_POST['registeremail'])){
                $regEmail = "/^\w+([\.\-]?\w+)*\@\w+([\.\-]?\w+)*(\.\w{2,3})+$/";
                if(preg_match($regEmail,$_POST['registeremail'])){
                    include('dbconnection.php');
                    $query = sprintf("SELECT userID FROM users WHERE email=%s",$_POST['registeremail']);
                    $result = mysql_query($query, $connect);
                    if(mysql_num_rows($result)==1){
                        $row = mysql_fetch_array($result);
                        $newpassword="";
                        $characters = '0123456789abcdefghijklmnopqrstuvwxyz01234ABCDEFGHIJKLMNOPQRSTUVWXYZ56789';
                        for($i=0;$i<6;$i++){
                            $newpassword .= $characters[rand(0, strlen($characters) - 1)];
                        }
                        $query = sprintf("UPDATE users SET password='%s' WHERE userID=%d",$newpassword,$row['userID']);
                        $result = mysql_query($query,$connect);
                        if($result){
                            $msg="<html><head></head><body>
                                <div style='margin:0 auto;margin-top:50px;'>
                                <p style='font-size: 30px;text-align:center;margin-bottom:150px;'>We have changed your password</p>
                                <p style='background:#00bfd9;border-radius:6px;font-size:21px;padding:18px 10px;border:none;color:#fff;letter-spacing:1px;margin: auto;text-align: center;width:362px;margin: 50px 0px;text-decoration:none;text-align: center;display:block;'>
                                ".$newpassword."
                                </p>
                                <div>Your new password is: ".$newpassword."</div>
                                </div></body></html>";

                            $headers = "MIME-Version: 1.0" . "\r\n";
                            $headers .= "Content-type:text/html;" . "\r\n";
					
					        mail(trim($_POST['registeremail']),"New Password | My socks",$msg,$headers);
                            success("Your password is changed.");
                        }
                        else{
                            warning('Sorry but we couldnt change your password.');
                        }
                    }
                }
                else{
                    error('Email must be valid.');
                }
            }
        }
    }
?>
<div class="logintext">My socks</div>
<div class="loginline"></div>
<div class="loginlinetext forgotpasswordtext">Forgot your password?</div>

<div class="loginform">
    <form action="<?php echo $_SERVER['PHP_SELF']?>" method='POST' id='unsubform' onsubmit="return submitforgotemail();">
        <input type='hidden' name='page' value='8'>
        <input type="text" name='unsubemail' id='forgotemail' placeholder='E-MAIL' oninput="setCustomValidity('');"/>

        <input type='submit' name='unsubsubmit' id='forgotsubmit' value='RESTART'/>
    </form>
</div>