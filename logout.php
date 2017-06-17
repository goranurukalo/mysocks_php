<?php
    if(isset($_SESSION['role'])){
			unset($_SESSION['role']);
			unset($_SESSION['userID']);
			unset($_SESSION['numBagItems']);
			session_destroy();
		}
	header('Location: index.php');
?>