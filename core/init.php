<?php
ini_set('session.save_path',getcwd().'/temp'); 
session_start();
 ob_start();
//echo session_save_path();
error_reporting(0);
require 'database/connect.php';
/*<?php
mysql_connect('localhost','pedramlib','pedramlib123') or die('could not connect:' .mysql_error());
mysql_select_db('libbookstore') or die('can\'t use'.libbookstore.':'.mysql_error());
?>*/
//require 'functions/general.php';
require 'functions/users.php';

if(logged_in()===true){
	$session_user_id=$_SESSION['user_id'];
	$user_data=user_data($session_user_id,'id','username','password','fname','lname','email_code','email','active','type','allow_email');
	//echo $user_data['type'];
	if(user_active($user_data['username'])===false){
		session_destroy();
		header('Location:index.php');
		exit();
	}
}

$errors=array();
?>