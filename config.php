<?php



date_default_timezone_set('Asia/Kolkata');
// Create connection
$database_username = 'root';

	$database_password = '';
	$con = new PDO( 'mysql:host=localhost;dbname=rdtc_cps', $database_username, $database_password );


?>