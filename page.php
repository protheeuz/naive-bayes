<?php if(!defined('myweb')){ exit(); }?>
<?php
/*
---------------------------------------------
Developed by Matimatech
Website 				: https://www.Matimatech
Email					: Matimatech@gmail.com
Telp/ SMS/ WhatsApp		: 0852 0404 5555
---------------------------------------------
*/
$actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

$url_tmp = str_replace($www, '', $actual_link);
$url_tmp = explode('/',$url_tmp);
switch($url_tmp[0]){
	case 'kriteria':
	case 'kriteria_update':
	case 'subkriteria':
	case 'subkriteria_update':
	case 'dataset':
	case 'dataset_update':
	case 'hasil':
	case 'analisa':
	case 'password_update':
		$_GET['hal'] = $url_tmp[0];
		break;
	default:
		$_GET['hal'] = '';
		break;
}

$page='';
if(isset($_GET['hal'])){
	$page=$_GET['hal'];
}
$current_page=$page;
$must_login = true;
switch($page){
	case 'kriteria':
		$page="include 'includes/kriteria.php';";
		break;
	case 'kriteria_update':
		$page="include 'includes/kriteria_update.php';";
		break;
	case 'subkriteria':
		$page="include 'includes/subkriteria.php';";
		break;
	case 'subkriteria_update':
		$page="include 'includes/subkriteria_update.php';";
		break;
	case 'dataset':
		$page="include 'includes/dataset.php';";
		break;
	case 'dataset_update':
		$page="include 'includes/dataset_update.php';";
		break;
	case 'password_update':
		$page="include 'includes/password_update.php';";
		break;

	case 'hasil':
		$page="include 'includes/hasil.php';";
		break;
	case 'analisa':
		$page="include 'includes/analisa.php';";
		break;

	default:
		$page="include 'includes/home.php';";
		break;
}
$CONTENT_["main"] = $page;
if($must_login == true and !isset($_SESSION['LOGIN_ID'])){
	exit("<script>location.href='".$www."';</script>");
}

?>