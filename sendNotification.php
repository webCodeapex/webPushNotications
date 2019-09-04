<?php
// YOU CAN GENERATE A NEW ONE IN FIREBASE CONSOLE (https://console.firebase.google.com/) -> CLICK ON YOUR PROJECT -> ON THE LEFT TOP, CLICK ON THE SETTINGS ICON , NEAR PROJECT OVERVIEW -> CLICK ON CLOUD MESSAGING -> IN PROJECT CREDENTIALS SECTION SERVER KEY EXISTS
define('API_ACCESS_KEY','PUT-SERVER-KEY-HERE');
$url = 'https://fcm.googleapis.com/fcm/send';
$body = '';
$result = '';

if(isset($_POST['sendNotification'])){
	$body = $_POST['body'];

	$fields = array( 
		'to' => 'TOKEN-OF-DEVICE-YOU-WANTED-TO-SEND-NOTIFICATION', 
		'notification'  => array(
			'title'     => 'FCM Notification',
			'body'      => $body
		)
	);
	$fields = json_encode($fields);
	
	$headers = array( 
		'Authorization: key='.API_ACCESS_KEY, 
		'Content-Type: application/json'
	);
	$ch = curl_init();
	curl_setopt( $ch,CURLOPT_URL,$url);
	curl_setopt( $ch,CURLOPT_POST,true);
	curl_setopt( $ch,CURLOPT_HTTPHEADER,$headers);
	curl_setopt( $ch,CURLOPT_RETURNTRANSFER,true);
	curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER,false);
	curl_setopt( $ch,CURLOPT_POSTFIELDS,$fields);
	$result = curl_exec($ch);
	curl_close($ch);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
</head>
<body>
	<form action="sendNotification.php" method="post">
		<label for="body">Enter Message Here</label>
		<input type="text" id="body" name="body"><br><br>

		<input type="submit" name="sendNotification">
	</form>
	<p><?= $result?></p>
</body>
</html>