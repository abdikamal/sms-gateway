<div class="panel panel-default">
	<div class="panel-heading">
		<h1 class="panel-title">SMS Gateway</h1>
	</div>

	<div class="panel-body">
		<form method="post" action="controllers/send_sms_controller.php">


			<div class="form-group">
				<label>Recipients</label>
				<textarea class="form-control" name="recipients"></textarea>
				<p class="help-block">Enter phone numbers, separated with a comma</p>
			</div>

			<div class="form-group">
				<label>Message</label>
				<textarea class="form-control" name="textmessage" rows="5"></textarea>
				<p class="help-block">Enter the message to send</p>
			</div>

			<button class="btn btn-success btn-block">Send Message</button>
		</form>
	</div>

</div>
