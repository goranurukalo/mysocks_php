<?php
    if(isset($_SESSION['role'])){
        header('Location: index.php');
    }
    else{
        $error = 0;
        $status = 1;

        $data = array();
        if(isset($_POST['logsubmit'])){
            if(isset($_POST['logemail'])){
                $regEmail = "/^\w+([\.\-]?\w+)*\@\w+([\.\-]?\w+)*(\.\w{2,3})+$/";

                if(!preg_match($regEmail,$_POST['logemail'])){
                    $error = 1;
                }
                else{
                    $data['email'] = $_POST['logemail'];
                }
            }
            else{
                $error = 1;
            }

            if(isset($_POST['logpass'])){
                $regPassword = "/^[a-zA-Z0-9!@#$%^&*.]{6,}$/";

                if(!preg_match($regPassword,$_POST['logpass'])){
                    $error = 1;
                }
                else{
                    $data['password'] = $_POST['logpass'];
                }
            }
            else{
                $error = 1;
            }

            if($error == 0){
                include("dbconnection.php");
                $query = sprintf("SELECT * FROM users WHERE email='%s' AND password='%s'",$data['email'],md5($data['password']));
                $result = mysql_query($query, $connect);

                if(mysql_num_rows($result) == 1){
                    $row = mysql_fetch_array($result);
                    if($row['statusID'] == 1){
                        $_SESSION['role'] = $row['roleID'];
                        $_SESSION['userID'] = $row['userID'];

                        $countquery = sprintf("SELECT COUNT(*) count FROM shoppingbaglist WHERE userID=%d",$_SESSION['userID']);
                        $countresult = mysql_query($countquery, $connect);
                        mysql_close($connect);

                        $_SESSION['numBagItems'] = mysql_fetch_array($countresult)['count']; 
                         
                        header('Location: index.php');
                    }
                    else{
                        $status = $row['statusID'];
                    }
                }
                else{
                    $error = 1;
                }
            }
        }
    }
        include('msg.php');
        if($error == 1){
            error('Email or password is not correct.');
        }
        if($status != 1){
            if($status == 2){
                error('Your email is banned.');
            }
            else if($status == 3){
                info('First you need to verified your email.');
            }
            else if($status == 4){
                warning('Your email is deleted.');
            }
        }
?>
<div class="logintext">My socks</div>
<div class="loginline"></div>
<div class="loginlinetext">Log in</div>

<div class="loginform">
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method='POST' id='loginform' onsubmit="return submitlogin();">
        <input type="hidden" name='page' value='3'>
        <input type="text" name='logemail' id='logemail' placeholder='E-MAIL' value='<?php echo @$_POST['logemail'];?>' oninput="setCustomValidity('');"/>
        <input type='password' name='logpass' id='logpass' placeholder='PASSWORD' oninput="setCustomValidity('');"/>

        <input type='submit' name='logsubmit' id='logsubmit' value='SIGN IN'/>
    </form>
</div>

<div class="loginforgotpass"><a href="index.php?page=8">Forgot your password?</a></div>