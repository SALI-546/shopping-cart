<?php
	$conn = new mysqli("localhost","dbusername","dbpassword","dbname");
	if($conn->connect_error){
		die("Connection Failed!".$conn->connect_error);
	}
?>
