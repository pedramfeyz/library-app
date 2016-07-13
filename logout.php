<?php
ini_set('session.save_path',getcwd().'/temp'); 
session_start();
session_destroy();
//unset($_SESSION['user_id']);
header('Location: index.php');
?>