<?php
/*
---------------------------------------------
Developed by Matimatech
Website 				: https://www.Matimatech
Email					: hello@Matimatech
Telp/ SMS/ WhatsApp		: 0878 7160 4309
---------------------------------------------
*/
$db_host 		= 'localhost';
$db_user 		= 'root';
$db_password 	= '';
$db_name 		= 'db_rizky';

$www 			= 'http://localhost/naive_bayes/';

$con = @new mysqli($db_host, $db_user, $db_password, $db_name);
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
} 
?>