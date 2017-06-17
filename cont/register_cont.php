<?php @session_start();
    if(isset($_SESSION['role'])){
        header('Location: index.php');
    }
    else{
        if(isset($_POST['registersubmit'])){
            include('msg.php');
                    $error = 0;

                    if(isset($_POST['registername'])){
                        $regFirstName = "/^[A-Z]{1}[a-z]{2,30}$/";
                        if(!preg_match($regFirstName,$_POST['registername'])){
                            $error++;
                            error('First name must be valid.');
                        }
                        else{
                            $userdata['firstname'] = $_POST['registername'];
                        }
                    }
                    else{
                        $error++;
                        error('First name must be valid.');
                    }

                    if(isset($_POST['registerlastname'])){
                        $regLastName = "/^[A-Z]{1}[a-z]{3,30}$/";
                        if(!preg_match($regLastName,$_POST['registerlastname'])){
                            $error++;
                            error('Last name must be valid.');
                        }
                        else{
                            $userdata['lastname'] = $_POST['registerlastname'];
                        }
                    }
                    else{
                        $error++;
                        error('Last name must be valid.');
                    }
                    if(isset($_POST['registeremail'])){
                        $regEmail = "/^\w+([\.\-]?\w+)*\@\w+([\.\-]?\w+)*(\.\w{2,3})+$/";
                        if(!preg_match($regEmail,trim($_POST['registeremail']))){
                            $error++;
                            error('Email must be valid.');
                        }
                        else{
                            $userdata['email'] = trim($_POST['registeremail']);
                        }
                    }
                    else{
                        $error++;
                        error('Email must be valid.');
                    }
                    if(isset($_POST['registerpass'])){
                        $regPassword = "/^[a-zA-Z0-9!@#$%^&*.]{6,128}$/";
                        if(!preg_match($regPassword,$_POST['registerpass'])){
                            $error++;
                            error('Password must be valid.');                            
                        }
                        else{
                            $userdata['password'] = $_POST['registerpass'];
                        }
                    }
                    else{
                        $error++;
                        error('Password must be valid.');
                    }
                    if(isset($_POST['registerpassagain'])){
                        if($_POST['registerpass'] != $_POST['registerpassagain']){
                            $error++;
                        }
                    }
                    else{
                        $error++;
                    }
                    if($error == 0){
                        include('dbconnection.php');
                        $query = sprintf("SELECT * FROM users WHERE email = '%s'",$userdata['email']);
                        $result = mysql_query($query,$connect);

                        if(!mysql_num_rows($result)){

                        
                            $userdata['role'] = 2;
                            $userdata['timeOfReg'] = mktime();
                            $userdata['verificationCode'] = "";
                            $characters = '0123456789abcdefghijklmnopqrstuvwxyz01234ABCDEFGHIJKLMNOPQRSTUVWXYZ56789';
                            for($i=0;$i<20;$i++){
                                $userdata['verificationCode'] .= $characters[rand(0, strlen($characters) - 1)];
                            }
                            $userdata['statusID'] = 3;
                        
                            $query = sprintf("INSERT INTO users VALUES('','%s','%s','%s','%s', %d, %d,'%s',%d)",$userdata['firstname'],$userdata['lastname'],$userdata['email'],md5($userdata['password']),$userdata['role'],$userdata['timeOfReg'],$userdata['verificationCode'],$userdata['statusID']);
                            
                            $r = mysql_query($query,$connect);
                            mysql_close($connect);
                            
                            if(!$r){
                                echo"<div class='errorlog'>We apologize but there was a little mistake</div>";
                            }else{				
                                $verHref = "cont/verification_cont.php?vc=".$userdata['verificationCode']."&m=".$userdata['email'];
                                
                                $msg="<html><head></head><body>
                                    <div style='margin:0 auto;margin-top:50px;'>
                                    <p style='font-size: 30px;text-align:center;margin-bottom:150px;'>Hello ".$userdata['firstname']." ".$userdata['lastname']."</p>
                                    <a style='background:#00bfd9;border-radius:6px;font-size:21px;padding:18px 10px;border:none;color:#fff;letter-spacing:1px;margin: auto;text-align: center;width:362px;margin: 50px 0px;text-decoration:none;text-align: center;display:block;' 
                                    href='".$verHref."'>Verification</a>
                                    </div></body></html>";

                                $headers = "MIME-Version: 1.0" . "\r\n";
                                $headers .= "Content-type:text/html;" . "\r\n";
                    
                                mail(trim($_POST['email']),"Verified link | My socks",$msg,$headers);
                                
                            }
                        }else{
                            warning('Email already exist.');
                        }
                    }
                }
    }
?>

<div class='registertext'>My socks</div>
<div class='loginline'></div>
<div class='registerlinetext'>Register</div>

<div class='registerform'>
    <form action='<?php echo $_SERVER['PHP_SELF'];?>' method='POST' id='loginform' onsubmit='return registration();'>
        <input type='hidden' name='page' value='4'>
        <input type='text' name='registername' id='registername' placeholder='FIRST NAME' value='<?php echo @$_POST['registername'];?>' oninput="setCustomValidity('');">
        <input type='text' name='registerlastname' id='registerlastname' placeholder='LAST NAME' value='<?php echo @$_POST['registerlastname'];?>' oninput="setCustomValidity('');">
        <input type='text' name='registeremail' id='registeremail' placeholder='E-MAIL' value='<?php echo @$_POST['registeremail'];?>' oninput="setCustomValidity('');">
        <input type='password' name='registerpass' id='registerpass' placeholder='PASSWORD' value='<?php echo @$_POST['registerpass'];?>' oninput="setCustomValidity('');">
        <input type='password' name='registerpassagain' id='registerpassagain' placeholder='RE-ENTER PASSWORD' value='<?php echo @$_POST['registerpassagain'];?>' oninput="setCustomValidity('');">

        <input type='submit' name='registersubmit' id='registersubmit' value='CREATE ACCOUNT'/>
    </form>
</div>

<div class='loginforgotpass'><a href='index.php?page=3'>Already have an account?</a></div>
