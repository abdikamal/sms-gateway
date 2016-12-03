<?php
// require_once 'bootstrap/init.php';
require_once 'bin/AfricasTalkingGateway.php';

function sendMessage($message, $to)
{
	try {
		$username = "Budu";
		$key = "ec28c00375a620bea6cce512a165bf6aef8e500d2aa8dc844a1e0b86be8fb0dc";

		$gateway = new AfricasTalkingGateway($username, $key);

		$results = $gateway->sendMessage($to, $message);
	} catch (Exception $e) {
		echo json_encode($e);
		exit;
	}
}

$sent = false;

if($_SERVER['REQUEST_METHOD'] === 'POST') {
	$recipients = $_POST['recipients'];
	$message = $_POST['textmessage'];

	$results = sendMessage($message, $recipients);

	$sent = true;
}

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
			<?php if ($sent) : ?>
				<div class="alert alert-success">
					<p>Message has been submitted for sending!</p>
				</div>
			<?php endif; ?>
			<?php require_once 'views/sendsms.php' ?>
		</div>
	</div>
	
	<script type="text/javascript" src="libs/js/jquery.min.js"></script>
	<script type="text/javascript" src="libs/js/bootstrap.min.js"></script>
</body>
</html>