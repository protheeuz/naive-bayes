<?php
/*
---------------------------------------------
Developed by Matimatech
Website 				: https://www.Matimatech
Email					: Matimatech@gmail.com
Telp/ SMS/ WhatsApp		: 0852 0404 5555
---------------------------------------------
*/
session_name('session_k_means');
session_start();
require_once 'config.php';
$con->close();
session_destroy();
session_unset();
exit("<script>window.location='".$www."';</script>");

?>