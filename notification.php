<?php
ini_set('session.save_path',getcwd().'/temp'); 
session_start();
ob_start();

if (isset($_GET['user'])) {
	$notification=$_GET['user'];
	//echo $_GET['recipient'];
	$_SESSION[$notification]+=1;
	echo $notification.":".$_SESSION[$notification];

}
?>