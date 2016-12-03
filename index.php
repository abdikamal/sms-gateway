<?php
require_once 'bootstrap/init.php';
require_once 'bin/AfricasTalkingGateway.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>SMS Gateway</title>
	<link rel="stylesheet" type="text/css" href="libs/css/bootstrap.min.css">
</head>
<body>
	<header>
		<?php require_once 'views/header.php' ?>
	</header>
	<div class="container">
		<div>
			<?php require_once 'views/sendsms.php' ?>
		</div>
	</div>
	
	<script type="text/javascript" src="libs/js/jquery.min.js"></script>
	<script type="text/javascript" src="libs/js/bootstrap.min.js"></script>
</body>
</html>