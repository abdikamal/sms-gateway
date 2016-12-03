<?php 
require_once '../bin/AfricasTalkingGateway.php';
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

if($_SERVER['REQUEST_METHOD'] === 'POST') {
	$recipients = $_POST['recipients'];
	$message = $_POST['textmessage'];

	$results = sendMessage($message, $recipients);

	header("location: ../index.php");
}

