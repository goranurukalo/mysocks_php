<?php
    if(!isset($_SESSION['role'])){
        header('Location: index.php');
    }else{
        if(isset($_POST['myprofilesubmit'])){
            #upisi
            if(isset($_POST['firstname'])&&isset($_POST['lastname'])){
                $error = 0;
                include('msg.php');
                $regFirstName = "/^[A-Z]{1}[a-z]{2,30}$/";
                if(!preg_match($regFirstName,$_POST['firstname'])){
                    $error++;
                    error('First name must be valid.');
                }
                $regLastName = "/^[A-Z]{1}[a-z]{3,30}$/";
                if(!preg_match($regLastName,$_POST['lastname'])){
                    $error++;
                    error('Last name must be valid.');
                }
                
                if(!$error){
                    include('dbconnection.php');
                    $query = sprintf("UPDATE users SET firstName='%s', lastName='%s' WHERE userID=%d", $_POST['firstname'], $_POST['lastname'], $_SESSION['userID']);
                    $result = mysql_query($query,$connect);
                    mysql_close($connect);
                }
            }
            header('Location: index.php?page=15');
        }
        else{
            include('dbconnection.php');
            $query = sprintf("SELECT * FROM users WHERE userID=%d",$_SESSION['userID']);
            $result = mysql_query($query,$connect);
            mysql_close($connect);
            $row;
            if(mysql_num_rows($result)>0){
                $row = mysql_fetch_array($result);

                if(!isset($_REQUEST['manage'])){
                    echo"<div class='logintext'>My socks</div>
                        <div class='loginline'></div>
                        <div class='loginlinetext myprofiletext'>My profile</div>";
                    echo"<div class='myprofile'>
                        
                        <div class='firstname'>".$row['firstName']."</div>
                        <div class='lastname'>".$row['lastName']."</div>
                        <div class='mpemail'>".$row['email']."</div>
                        <div class='dateofreg'>".(@date('d/m/Y H:i:s',$row['timeOfReg']))."</div>
                        <a class='myprofilemanage' href='index.php?page=15&manage=1'>MANAGE PROFILE</a>
                    </div>";
                }
                else{
                    echo"<div class='logintext'>My socks</div>
                        <div class='loginline'></div>
                        <div class='loginlinetext myprofiletext'>Manage profile</div>";
                    echo"<div class='myprofile'>
                        <form action='".$_SERVER['PHP_SELF']."' method='POST' onsubmit='return submitmyprofile();'>
                            <input type='hidden' name='page' value='15'>

                            <input type='text' name='firstname' id='firstname' value='".$row['firstName']."' placeholder='FIRST NAME' oninput=\"setCustomValidity('');\">
                            <input type='text' name='lastname' id='lastname' value='".$row['lastName']."' placeholder='LAST NAME'  oninput=\"setCustomValidity('');\">
                            
                            <input type='submit' name='myprofilesubmit' id='myprofilesubmit' value='MANAGE PROFILE'>
                        </form>
                    </div>";
                }
            }
        }
    }
?>
