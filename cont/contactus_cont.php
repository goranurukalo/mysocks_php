<?php
    $error = 0;
    $errlist = array();
    $regName = "/^[A-Z]{1}[a-z]{3,19}\s[A-Z]{1}[a-z]{3,28}$/";
	$regEmail = "/^\w+([\.\-]?\w+)*\@\w+([\.\-]?\w+)*(\.\w{2,3})+$/";
	$regQuestion = "/^[\w\d\s\.\,\!\?]{2,255}$/";
    include('msg.php');
	if(isset($_POST['contussubmit'])){
        if(!preg_match($regName,trim($_POST['contusfullname']))){
            $error++;
            error('Full name must be valid.');
        }
        if(!preg_match($regEmail,trim($_POST['contusemail']))){
            $error++;
            error('Email must be valid.');
        }
        if(!preg_match($regQuestion,trim($_POST['contusquestion']))){
            $error++;
            error('Question must be valid.');
        }
        
        if($error == 0){
            # posalji mejl
            $msg = 
                "<html><head></head><body>
                <div style='margin:0 auto;margin-top:50px;'>
                <p style='font-size: 30px;text-align:center;margin-bottom:100px;'>I'm ".$_GET['fl_name']."</p>
                <p style='font-size: 30px;text-align:center;margin-bottom:50px;'>Email: ".$_GET['email']."</p>
                <p style='font-size: 30px;text-align:center;margin-bottom:50px;'>".$_GET['question']."</p>
                </div></body></html>";

	        $headers = "MIME-Version: 1.0" . "\r\n";
	        $headers .= "Content-type:text/html;" . "\r\n";
	
	        mail("goran.urukalo.117.14@ict.edu.rs","Contact form | My socks", $msg, $headers);
        }
    }
?>

<div class="logintext">My socks</div>
<div class="loginline"></div>
<div class="loginlinetext contuslinetext">Contact us</div>

<div class="contusfeelfree">Feel free to ask any question.</div>

<div class="loginform">
    <form action="<?php echo $_SERVER['PHP_SELF']?>" method='POST' id='loginform' onsubmit="return submitcontactform();">
        <input type="hidden" name='page' value='10'>
        <input type="text" name='contusfullname' id='contusfullname' placeholder='FULL NAME' oninput="setCustomValidity('');"/>
        <input type="text" name='contusemail' id='contusemail' placeholder='E-MAIL' oninput="setCustomValidity('');"/>
        <textarea name='contusquestion' id='contusquestion' placeholder='Ask any question.' class='contustextarea' oninput="setCustomValidity('');"></textarea>
        <input type='submit' name='contussubmit' id='contussubmit' value='SEND'/>
    </form>
</div>

<div class="loginline poolline"></div>
<div class="loginlinetext ">Pool</div>


<?php
    include('dbconnection.php');
    $canvote = 1;
    
    if(isset($_POST['poolsubmit'])){
        #pitaj da li je ista doslo posto moze da ne cekira nista
        if(isset($_POST['pollID']) && isset($_POST['pollformanswer'])){

            if(preg_match("/^\d+$/", $_POST['pollID'])){
                $query = sprintf("SELECT * FROM pollvotes WHERE pollQuestionID = %d AND ipAddress='%s' ",$_POST['pollID'],$_SERVER["REMOTE_ADDR"]);
                $result = mysql_query($query,$connect);
                if(mysql_num_rows($result)>0){
                    echo "u have already vote";
                    $canvote = 0;
                }
                else{
                    if(preg_match("/^\d+$/", $_POST['pollformanswer'])){
                        $query = sprintf("INSERT INTO pollvotes VALUES('',%d,%d,'%s')",$_POST['pollID'],$_POST['pollformanswer'],$_SERVER["REMOTE_ADDR"]);
                        $result = mysql_query($query,$connect);
                        if($result){
                            echo "thanks for voting";
                            $query = sprintf("UPDATE pollanswer SET vote=vote+1 WHERE pollAnswerID=%d",$_POST['pollformanswer']);
                            $result = mysql_query($query,$connect);
                        }    
                    } 
                }
            }
        }
    }

    if($canvote){
    $query = sprintf("SELECT * FROM pollquestion WHERE onOff = 1 LIMIT 1");
    $result = mysql_query($query,$connect);
    if(mysql_num_rows($result)>0){
        $row = mysql_fetch_array($result);
        echo "
        <div class='poolquestion'>".$row['pollQuestion']."</div>
    
    <form action='".$_SERVER['PHP_SELF']."' id='poolquestion' class='radiobuttonparent' method='POST'>
        <input type='hidden' name='page' value='10'>
        <input type='hidden' name='pollID' value='".$row['pollQuestionID']."'>
    <ul>";
    $query = sprintf("SELECT * FROM pollanswer WHERE pollQuestionID=%d",$row['pollQuestionID']);
    $res = mysql_query($query,$connect);
    $i = 1;
    while($r = mysql_fetch_array($res)){
        echo "<li>
            <input type='radio' name='pollformanswer' id='poll".$i."' value='".$r['pollAnswerID']."'>
            <label for='poll".$i."' class='radiobuttonlable'>".$r['pollAnswer']."</label>
            <div class='check'></div>
        </li>";
        $i++;
    }
    echo"</ul>

    <input type='submit' value='VOTE' name='poolsubmit' id='poolsubmit'/>
</form>";
    }
    }
?>

