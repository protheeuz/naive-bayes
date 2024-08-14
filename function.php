<?php
function escape($str){
	global $con;
	$str = mysqli_real_escape_string($con,$str);
	return $str;
}

?>