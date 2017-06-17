<?php @session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>My socks</title>
	<link rel="stylesheet" type="text/css" href="css/mystyle.css">
	<link rel="shortcut icon" href="images/socks_icon.png">

	<script type="text/javascript" src="js/script.js"></script>
		
	<meta name="keywords" content="socks"/>
	<meta name="description" content="Socks"/>
	
</head>
<body>
	<div id="site">
	<?php
		include("cont/visit_cont.php");
		$page = '1';
		if(isset($_REQUEST['page'])){
			$page = $_REQUEST['page'];
		}

		include("cont/header_cont.php");

        $contpages = array(
        '0' => "404.php",
        '1' => "cont/index_cont.php",
        '2' => "cont/author_cont.php",
        '3' => "cont/login_cont.php",
        '4' => "cont/register_cont.php",
        '5' => "cont/search_cont.php",
		'6' => "cont/newsletter_cont.php",
		'7' => "cont/unsubscribe_cont.php",
		'8' => "cont/forgotpassword_cont.php",
		'9' => "cont/faq_cont.php",
		'10' => "cont/contactus_cont.php",
		'11' => "cont/product_cont.php",
		'12' => "cont/oneproduct_cont.php",
		'13' => "cont/shoppingbag_cont.php",
		'14' => "logout.php",
		'15' => "cont/myprofil_cont.php"
        );

		echo "<div class='container wmax'>";
		
        if(isset($contpages[$page]))
          	include($contpages[$page]);
        else
        	include($contpages['0']);
		
		echo "</div>";
	
		include("cont/footer_cont.php");
	?>
	</div>
</body>
</html>