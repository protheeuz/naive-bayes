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
define('myweb',true);

require_once 'config.php';
require_once 'function.php';

if(isset($_SESSION['LOGIN_ID'])){
	require_once 'page.php';
	if(isset($_POST['save']) or isset($_POST['delete'])){
		eval($CONTENT_["main"]);
		//header('HTTP/1.1 500 Internal Server Error');
		//echo 'Tidak diperkenankan untuk menambah/ mengubah/ menghapus data pada versi demo ini';
		//die;
	}elseif(isset($_POST['hitung'])){
		eval($CONTENT_["main"]);
	}else{
		require_once 'template.php';
	}
	
}else{
	require_once 'template_login.php';
}
$con->close();
?>