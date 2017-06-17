<?php @session_start();
	if(!isset($_SESSION['role'])){
		header('Location: index.php');
	}
	else if($_SESSION['role'] != 1){
		header('Location: index.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>AdminPanel | My socks</title>
	<link rel="stylesheet" type="text/css" href="css/shhh.css">
	<link rel="shortcut icon" href="images/settings.png">

	<script type="text/javascript" src="js/cpscript.js"></script>
	<script type="text/javascript" src="js/jquery.js"></script>

	<meta name="keywords" content="no one know"/>
	<meta name="description" content="Socks cpanel"/>
	
</head>
<body>
	<div id="site">
	<?php
		$page = '1';
		if(isset($_REQUEST['page'])){
			$page = $_REQUEST['page'];
		}

        include("gogistuff/header_cont.php");

        $contpages = array(
        '0' => "404.php",
        '1' => "gogistuff/index_cont.php",
        
        '2' => "gogistuff/every_cont.php",
        '3' => "gogistuff/every_cont.php",
        '4' => "gogistuff/every_cont.php",
        '5' => "gogistuff/every_cont.php",
        '6' => "gogistuff/every_cont.php",
		
        '7' => "gogistuff/index_cont.php",

		'8' => "gogistuff/mod/user.php",
		'9' => "gogistuff/mod/product.php",
		'10' => "gogistuff/mod/sale.php",
		'11' => "gogistuff/mod/faq.php",
		'12' => "gogistuff/mod/poll.php"
        );

		echo "<div class='container wmax'>";
		
        if(isset($contpages[$page]))
          	include($contpages[$page]);
        else
        	include($contpages['0']);
		
		echo "</div>";
	
		include("gogistuff/footer_cont.php");
	?>
	</div>
</body>
</html>