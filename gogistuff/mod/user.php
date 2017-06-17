<?php
if($_SESSION['role']==1){
    if(!isset($_REQUEST['job'])){
        header('location: n1shhh.php');
    }else{
        $job = $_REQUEST['job'];
        if(!($job > 0 && $job<5)){
            header('location: n1shhh.php');
        }
        else{

            if($job == '1'){
                if(isset($_POST['submituseradd'])){
                    
                    $error = 0;

                    if(isset($_POST['firstname'])){
                        $regFirstName = "/^[A-Z]{1}[a-z]{2,30}$/";
                        if(!preg_match($regFirstName,$_POST['firstname'])){
                            $error++;
                        }
                        else{
                            $userdata['firstname'] = $_POST['firstname'];
                        }
                    }
                    else{
                        $error++;
                    }

                    if(isset($_POST['lastname'])){
                        $regLastName = "/^[A-Z]{1}[a-z]{3,30}$/";
                        if(!preg_match($regLastName,$_POST['lastname'])){
                            $error++;
                        }
                        else{
                            $userdata['lastname'] = $_POST['lastname'];
                        }
                    }
                    else{
                        $error++;
                    }
                    if(isset($_POST['email'])){
                        $regEmail = "/^\w+([\.\-]?\w+)*\@\w+([\.\-]?\w+)*(\.\w{2,3})+$/";
                        if(!preg_match($regEmail,$_POST['email'])){
                            $error++;
                        }
                        else{
                            $userdata['email'] = $_POST['email'];
                        }
                    }
                    else{
                        $error++;
                    }
                    if(isset($_POST['password'])){
                        $regPassword = "/^[a-zA-Z0-9!@#$%^&*.]{6,128}$/";
                        if(!preg_match($regPassword,$_POST['password'])){
                            $error++;
                        }
                        else{
                            $userdata['password'] = $_POST['password'];
                        }
                    }
                    else{
                        $error++;
                    }

                    if($error == 0){

                        $userdata['role'] = 2;
                        $userdata['timeOfReg'] = mktime();
                        $userdata['verificationCode'] = "";
                        $characters = '0123456789abcdefghijklmnopqrstuvwxyz01234ABCDEFGHIJKLMNOPQRSTUVWXYZ56789';
                        for($i=0;$i<20;$i++){
                            $userdata['verificationCode'] .= $characters[rand(0, strlen($characters) - 1)];
                        }
                        $userdata['statusID'] = 1;
                    
                        $query = sprintf("INSERT INTO users VALUES('','%s','%s','%s','%s', %d, %d,'%s',%d)",$userdata['firstname'],$userdata['lastname'],$userdata['email'],md5($userdata['password']),$userdata['role'],$userdata['timeOfReg'],$userdata['verificationCode'],$userdata['statusID']);
                        include('dbconnection.php');
                        $r = mysql_query($query,$connect);
                        mysql_close($connect);
                        
                        if(!$r){
                            echo"<div class='errorlog'>We apologize but there was a little mistake</div>";
                        }
                        else{
                            echo"<div class='errorlog'>We add new user</div>";
                        }
                    
                    }
                    else {
                        echo "error";
                    }
                }
                
                    echo"
                    <div class='bigText'>USER > ADD</div>

                    <div class='useraddf forminside'>
                        <form action='".$_SERVER['PHP_SELF']."' method='POST' id='useraddform' onsubmit='return adduser();'>
                            <input type='hidden' name='page' value='".$page."'>
                            <input type='hidden' name='job' value='1'>
                            
                            <input type='text' name='firstname' id='firstname' placeholder='FIRST NAME' value='".@$_POST['firstname']."'>
                            <input type='text' name='lastname' id='lastname' placeholder='LAST NAME' value='".@$_POST['lastname']."'>
                            <input type='text' name='email' id='email' placeholder='E-MAIL'  value='".@$_POST['email']."'>
                            <input type='password' name='password' id='password' placeholder='PASSWORD'  value='".@$_POST['password']."'>

                            <input type='submit' name='submituseradd' id='submituseradd' value='ADD USER'>
                        </form>
                    </div>";
                

            }
            else{
                if(!isset($_REQUEST['productID'])){
                    include('funct/itemfunct.php');
                    fillitems(array('page'=>$page,'job'=>$job));
                }
                else{
                    if($job == 2){
                        if(isset($_REQUEST['productID'])){
                            if(preg_match("/^\d+$/", $_REQUEST['productID'])){
                            include("dbconnection.php");

                            if(isset($_POST['submitusermanage'])){

                                $error = 0;
                                if(isset($_POST['userID'])){
                                    $userdata['userID'] = $_POST['userID'];
                                }
                                else{
                                    $error++;
                                }
                                if(isset($_POST['firstname'])){
                                    $regFirstName = "/^[A-Z]{1}[a-z]{2,30}$/";
                                    if(!preg_match($regFirstName,$_POST['firstname'])){
                                        $error++;
                                    }
                                    else{
                                        $userdata['firstname'] = $_POST['firstname'];
                                    }
                                }
                                else{
                                    $error++;
                                }

                                if(isset($_POST['lastname'])){
                                    $regLastName = "/^[A-Z]{1}[a-z]{3,30}$/";
                                    if(!preg_match($regLastName,$_POST['lastname'])){
                                        $error++;
                                    }
                                    else{
                                        $userdata['lastname'] = $_POST['lastname'];
                                    }
                                }
                                else{
                                    $error++;
                                }
                                if(isset($_POST['email'])){
                                    $regEmail = "/^\w+([\.\-]?\w+)*\@\w+([\.\-]?\w+)*(\.\w{2,3})+$/";
                                    if(!preg_match($regEmail,$_POST['email'])){
                                        $error++;
                                    }
                                    else{
                                        $userdata['email'] = $_POST['email'];
                                    }
                                }
                                else{
                                    $error++;
                                }
                                if(isset($_POST['password'])){
                                    $regPassword = "/^[a-zA-Z0-9!@#$%^&*.]{6,128}$/";
                                    if($_POST['password'] == ''){
                                        
                                    }
                                    else if(!preg_match($regPassword,$_POST['password'])){
                                        $error++;
                                    }
                                    else{
                                        $userdata['password'] = md5($_POST['password']);
                                    }
                                }
                                else{
                                    $error++;
                                }

                                if(isset($_POST['timeofreg'])){
                                    $regTOR = "/^[1-9]{1}[0-9]{9}$/";
                                    if(!preg_match($regTOR,$_POST['timeofreg'])){
                                        $error++;
                                    }
                                    else{
                                        $userdata['timeofreg'] = $_POST['timeofreg'];
                                    }
                                }
                                else{
                                    $error++;
                                }
                                if(isset($_POST['verificationcode'])){
                                    $regVC = "/^[A-z0-9]{20}$/";
                                    if(!preg_match($regVC,$_POST['verificationcode'])){
                                        $error++;
                                    }
                                    else{
                                        $userdata['verificationcode'] = $_POST['verificationcode'];
                                    }
                                }
                                else{
                                    $error++;
                                }

                                if($error == 0){
                                    $query = "SELECT * FROM status";
                                    if(isset($userdata['password'])){
                                        $query = sprintf("UPDATE users SET firstName='%s', lastName='%s',email='%s' , roleID=%d, timeOfReg=%d, verificationCode='%s', statusID=%d , password='%s' WHERE userID=%d",$userdata['firstname'],$userdata['lastname'],$userdata['email'], $_POST['userrole'], $userdata['timeofreg'], $userdata['verificationcode'], $_POST['userstatus'] ,$userdata['password'],$userdata['userID']);

                                    }
                                    else{
                                        $query = 
                                        sprintf("UPDATE users SET 
                                        firstName='%s', 
                                        lastName='%s',
                                        email='%s', 
                                        roleID=%d, 
                                        timeOfReg=%d, 
                                        verificationCode='%s', 
                                        statusID=%d 
                                        WHERE userID=%d",$userdata['firstname'],$userdata['lastname'],$userdata['email'], $_POST['userrole'], $userdata['timeofreg'], $userdata['verificationcode'], $_POST['userstatus'] ,$userdata['userID']);

                                    }
                                    $result = mysql_query($query, $connect);
                                    if(!$result){
                                        echo"error";
                                    }
                                }
                                else{
                                    echo "error";
                                }
                            }
                
                            $query = sprintf("SELECT * FROM users u JOIN status s ON u.statusID = s.statusID  JOIN roles r ON u.roleID = r.roleID WHERE userID=%d",$_REQUEST['productID']);
                            $result = mysql_query($query, $connect);

                            $userroles = mysql_query("SELECT * FROM roles", $connect);
                            $userstatuses = mysql_query("SELECT * FROM status", $connect);
                            mysql_close($connect);

                            if(mysql_num_rows($result)){
                                $row = mysql_fetch_array($result);
                                
                                echo 
                                    "<div class='useraddf forminside'>
                                        <form action='".$_SERVER['PHP_SELF']."' method='POST' id='useraddform' onsubmit='return manageuser();'>
                                            <input type='hidden' name='page' value='".$page."'>
                                            <input type='hidden' name='job' value='".$job."'>
                                            <input type='hidden' name='productID' value='".$_REQUEST['productID']."'>
                                            <input type='hidden' name='userID' value='".$row['userID']."'>
                                            
                                            <input type='text' name='firstname' id='firstname' placeholder='FIRST NAME' value='".$row['firstName']."'>
                                            <input type='text' name='lastname' id='lastname' placeholder='LAST NAME' value='".$row['lastName']."'>
                                            <input type='text' name='email' id='email' placeholder='E-MAIL'  value='".$row['email']."'>
                                            <input type='password' name='password' id='password' placeholder='PASSWORD'  value=''>

                                            
                                            <select name='userrole' id='userrole'>
                                            
                                            ";
                                            while($r = mysql_fetch_array($userroles)){
                                                if($r['roleID'] == $row['roleID']){
                                                    echo "<option value='".$r['roleID']."' selected>".$r['role']."</option>";
                                                }
                                                else{
                                                    echo "<option value='".$r['roleID']."'>".$r['role']."</option>";
                                                }
                                            }   

                                echo"
                                            </select>
                                            <input type='text' name='timeofreg' id='timeofreg' placeholder='TIME OF REGISTER'  value='".$row['timeOfReg']."'>
                                            <input type='text' name='verificationcode' id='verificationcode' placeholder='VERIFICATION CODE'  value='".$row['verificationCode']."'>

                                            <select name='userstatus' id='userstatus'>
                                            ";

                                            while($r = mysql_fetch_array($userstatuses)){
                                                if($r['statusID'] == $row['statusID']){
                                                    echo "<option value='".$r['statusID']."' selected>".$r['status']."</option>";
                                                }
                                                else{
                                                    echo "<option value='".$r['statusID']."'>".$r['status']."</option>";
                                                }
                                            }  

                                echo"       <input type='submit' name='submitusermanage' id='submitusermanage' value='MANAGE USER'>
                                        </form>
                                    </div>";
                            }
                        }
                    }
                    }
                    else if($job == 3){
                        if(isset($_REQUEST['productID'])){
                            if(preg_match("/^\d+$/", $_REQUEST['productID'])){
                            include("dbconnection.php");
                            $query = sprintf("UPDATE users SET statusID = 4 WHERE userID=%d",$_REQUEST['productID']);
                            $result = mysql_query($query, $connect);
                            mysql_close($connect);
                        
                            if($result){
                                $offset = isset($_REQUEST['offset']) ? $_REQUEST['offset'] : 0;
                                header('location: n1shhh.php?page=8&job=3&offset='.$offset);
                            }
                        }
                    }
                    }
                    else if($job == 4){
                        if(isset($_REQUEST['productID'])){
                            if(preg_match("/^\d+$/", $_REQUEST['productID'])){
                        include("dbconnection.php");
                        $query = sprintf("SELECT * FROM users u JOIN status s ON u.statusID = s.statusID  JOIN roles r ON u.roleID = r.roleID WHERE userID=%d",$_REQUEST['productID']);
                        $result = mysql_query($query, $connect);
                        mysql_close($connect);
                        if(mysql_num_rows($result)){
                            
                        
                        $row = mysql_fetch_array($result);
                        echo"<div class='userblock profile'>
                            <div class='userID'>".$row['userID']."</div>
                            <div class='userfirstname'>".$row['firstName']."</div>
                            <div class='userlastname'>".$row['lastName']."</div>
                            <div class='useremail'>".$row['email']."</div>
                            <div class='userrole'>".$row['role']."</div>
                            <div class='usertimeofreg'>".@date('d/m/Y H:i:s',$row['timeOfReg'])."</div>
                            <div class='userverificationcode'>".$row['verificationCode']."</div>
                            <div class='userstatus'>".$row['status']."</div>
                            <a class='myprofilemanage' href='n1shhh.php?page=8&job=2&productID=".$row['userID']."&offset=0'>MANAGE</a>
                        </div>";
                        }
                        else{
                            echo "<div class='error'>Sorry but that product do not exist</div>";
                        }
                        }
                    }
                    }
                }
            }
        }
    }
}
?>