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
<?php

$new_msg_array=array();
$result=mysql_query("SELECT * FROM message WHERE recipient=$id AND check_read=0");
//$result=mysql_result($query,0);
while($row=mysql_fetch_assoc($result)){
	$new_msg_array[]=$row;
	$id_check_read=$row['id'];
	mysql_query("UPDATE message SET check_read=1  WHERE id =$id_check_read ");

	//print_r($row);echo "<br>";
};

mysql_query("UPDATE users SET new_message=0  WHERE id =$id ");
//print_r($new_msg_array);
?> 
<a href="showallmsg.php" style="float: right;margin-top: 20px;"><button class="btn btn-primary btn=md">show all messages</button></a><br><br><hr>
<ul id="out_ul_new_msg"> <?php
foreach ($new_msg_array as $temp) {

    $id_sender=$temp['sender'];
	$result=mysql_query("SELECT fname,profile_pic FROM users WHERE id=$id_sender ");
	$result=mysql_fetch_row($result);
	$applicant=$result[0];
    $pic=$result[1];//echo $pic;


    
?>
  <li class="out_li_new_msg">
    <ul class="in_ul_new_msg">

      <div style="background-color: ;width:220px;border-radius: 5px;opacity:.4;margin-top: 20px;padding: 5px;">
      <li class="in_li_new_msg"><img src= <?php  echo $temp['imagebook']   ?> style="width:60px;height: 60px;border-radius: 50px;" >  </li>
      <li class="in_li_new_msg" style="width:200px;word-wrap: break-word; ">title: <?php  echo $temp['title'];   ?> </li>
      <li class="in_li_new_msg">isbn: <?php  echo $temp['isbn'];   ?> </li>	
      </div>

      <li class="in_li_new_msg"><img src= <?php  echo $pic   ?> style="width:80px;height: 80px;border-radius: 5px;" >  </li>
   <!--   <li class="in_li_new_msg"> <?php  echo $temp['sender'];   ?> </li>  -->
      <li class="in_li_new_msg" style="width:200px;height:auto;word-wrap: break-word; "> <?php  echo $applicant.':'.$temp['message']   ?> </li>
      <li class="in_li_new_msg" style="font-size:10px;"> <?php  echo (substr($temp['time'],0,19));   ?> </li>

      <a href="#" class="toggleSendMessage" style="background-color: green;color: white;text-align: center;font-size: 1.4em;padding:4px;border-radius: 5px;"> reply the message </a>
                     <div  style="display: none;">
                     <textarea style="display:block;" class="mytext" placeholder="I would like to borrow the book,please"></textarea>
			 	     <button style="display: block;" class="btn btn-primary" name="<?php echo $temp['sender']; ?>" data-idsender='<?php echo $id; ?>'
			 	     data-idrecipient='<?php echo $temp['sender']; ?>'  data-idbook='<?php echo  $temp['isbn']; ?>' data-title='<?php echo  $temp['title']; ?>' data-imagebook='<?php echo  $temp['imagebook']; ?>' >send a message</button>
			 	     </div>
       
	  <br><br><br>

  </ul>
   </li> <?php	
}

?>
</ul>
</div>