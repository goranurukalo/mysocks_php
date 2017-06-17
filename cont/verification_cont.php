<?php @session_start();

	if(isset($_SESSION['role'])){
		header('Location: index.php');
	}	
	else if(isset($_GET['vc'])){
		
		$reg_vc = "/^[A-Za-z0-9]{20}$/";
		$reg_email = "/^\w+([\.\-]?\w+)*\@\w+([\.\-]?\w+)*(\.\w{2,3})+$/";
		
		if(preg_match($reg_vc,$_GET['vc']) && preg_match($reg_email,$_GET['m'])){

			$query = "SELECT userID, statusID FROM users WHERE verificationCode='".$_GET['vc']."' AND email='".$_GET['m']."'";
			include('../dbconnection.php');
			$rez = mysql_query($query,$connect);
			
			if(mysql_num_rows($rez)){
				$r = mysql_fetch_array($rez);
				if($r['statusID']==3){
					$query = "UPDATE users SET statusID='1' WHERE email='".$_GET['m']."' AND userID=".$r['userID'];
					$rez = mysql_query($query,$connect);
					if($rez){
						#good
						#http://localhost:1234/php2_php1site/cont/verification_cont.php?vc=UOVPq1dfbKSee6157mxJ&m=vera.veric@gmail.com
						# ^ test link
					}
				}
			}
			mysql_close($connect);
			
		}else{
			header('Location: ../index.php');
		}
		header('Location: ../index.php?page=3');
	}
	else{
		header('Location: ../index.php');
	}
?>