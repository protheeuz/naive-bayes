<?php
/*
---------------------------------------------
Developed by Matimatech
Website 				: https://www.Matimatech
Email					: Matimatech@gmail.com
Telp/ SMS/ WhatsApp		: 0852 0404 5555
---------------------------------------------
*/
session_name('session_naive_bayes');
session_start();
require_once 'config.php';
require_once 'function.php';
$error = '';

if(isset($_POST['login'])){
	if(empty($_POST['username']) or empty($_POST['password'])){
		$error = 'Lengkapi username dan password';
	}
	$username = $_POST['username'];
	$password = md5($_POST['password']);
	$q = $con->query("SELECT * FROM user WHERE username='".escape($username)."' AND password='".escape($password)."'");
	if ($q->num_rows > 0) {
		$h = $q->fetch_assoc();
		$_SESSION['LOGIN_ID'] = $h['id_user'];
		die;
	}else{
		$error = 'Username dan password salah';
	}
}

if(!empty($error)){
	header('HTTP/1.1 500 Internal Server Error');
	echo $error;
}

$con->close();

?>