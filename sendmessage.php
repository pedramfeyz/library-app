<?php
require 'connect.php';
$sender=$_GET['sender'];
$recipient=$_GET['recipient'];
$isbn=$_GET['isbn'];
$message=$_GET['message'];
$title=$_GET['title'];
$imagebook=$_GET['imagebook'];
$currentTime = date("Y-m-d H:i:s", time());

echo $sender.''.$recipient.''.$isbn.''.$message.''.$currentTime.''.$title.''.$imagebook.'<br>';

$query="INSERT INTO message (sender,recipient,isbn,title,imagebook,time,message) VALUES ('$sender','$recipient','$isbn','$title','$imagebook','$currentTime','$message')";
mysql_query($query);


$query="SELECT new_message FROM users WHERE id='$recipient'" ;
$result=mysql_query($query);
$temp=mysql_fetch_row($result);
//echo  $temp[0].'<br>';
$temp[0]+=1;
echo  $temp[0];
$query="UPDATE users SET new_message='$temp[0]' WHERE id='$recipient' ";
mysql_query($query);

?>