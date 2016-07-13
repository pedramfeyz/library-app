<?php
include 'connect.php';
include 'core/functions/users.php'; 
ini_set('session.save_path',getcwd().'/temp'); 
session_start();
ob_start();
protect_page();
$id=$_SESSION['user_id'];
$data=user($id);
///print_r($data);
include 'includes/overall/overallheadr.php';
include 'includes/overall/header.php';   
?>

<div class="container">

   
    
    <div class="clear"></div>
    <hr>
    <a href="findbooksnearme.php"><button  name="btnfindbooksnearme" class="btn btn-primary col-xs-12 col-sm-6 col-md-6 col-lg-4 col-lg-offset-4 col-md-offset-3 col-sm-offset-3">find books near me</button></a>
   
    
    
 
<div class="clear()" style="margin-bottom: 12em"></div>
<?php include 'slider.php' ?> 
<?php include 'includes/overall/overallfooter.php'?>
</div>

