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

//$new_msg_array=array();
$result=mysql_query("SELECT * FROM message WHERE recipient=$id OR sender=$id");
//$result=mysql_result($query,0);
while($row=mysql_fetch_assoc($result)){
	$msg_array[]=$row;
	$sender=$row['sender'];
	$recipient=$row['recipient'];
	if ($sender != $id ) { $classification[]=$sender;} else {$classification[]=$recipient;}
		//print_r($row);echo "<br>";
};
$classification=array_unique($classification);// make clasification based on diffrent users who send or receive msg
//print_r($classification);
$msg_array=array_reverse($msg_array) ;  
foreach ($classification as $temp_cfn) {//temp_classification
	//echo $temp_cfn.'<br>';
    
    $result=mysql_query("SELECT fname,profile_pic FROM users WHERE id=$temp_cfn ");
	$result=mysql_fetch_row($result);
	$chatname=$result[0];
    $pic=$result[1];
    ?>  
    <img src=" <?php echo $pic ?> "  style="width:60px;height: 60px;border-radius: 50px;">
    <a href="#" class="chat_name" style="color: blue;text-decoration: underline;"><?php echo $chatname ?></a>
    <div style="display: none;margin-top: 20px;">
    <?php 
         
	foreach ($msg_array as $temp) {
		$sender=$temp['sender'];
		$recipient=$temp['recipient'];
		if ($sender==$temp_cfn OR $recipient==$temp_cfn) {
			?>
			<section class="section_reply_all_msg">
          
           <?php  if ($sender != $id) { //if i sent this message  
                                ?> <div style="color: blue;font-size: .6em;width:200px;word-wrap: break-word;"> <?php echo 'title of book: '.$temp['title']; ?> </div> 
                                   <div style="color: blue;width:200px;word-wrap: break-word;"> <?php echo $temp['message'].'<br>'; ?> </div> 
                                   <div style="color: blue; font-size: .6em;"> <?php  echo (substr($temp['time'],0,19));   ?> </div>
                                <?php
                      }else{
                      	        ?> <div style="font-size: .6em;width:200px;word-wrap: break-word;"> <?php echo 'title of book: '.$temp['title']; ?> </div>
                      	           <div style="width:200px;word-wrap: break-word;"> <?php echo $temp['message'].'<br>'; ?> </div> 
                      	           <div style="font-size: .6em;"> <?php  echo (substr($temp['time'],0,19));   ?> </div>
                      	        <?php
                           } 
          ?> 
		  	  
			
          <?php  if ($sender != $id) { //if i sent this message don't put reply mes option 
         
           ?>
			<a href="#" class="toggleSendMessage" style="background-color: green;color: white;text-align: center;font-size: .7em;padding:4px;border-radius: 5px;"> reply the message </a>
                     <div class="textarea_button_all_msg" style="display: none;">
                     <textarea style="display:block;" class="mytext" placeholder="I would like to borrow the book,please"></textarea>
			 	     <button style="display: block;" class="btn btn-primary" name="<?php echo $temp['sender']; ?>" data-idsender='<?php echo $id; ?>'
			 	     data-idrecipient='<?php echo $temp['sender']; ?>'  data-idbook='<?php echo  $temp['isbn']; ?>' data-title='<?php echo  $temp['title']; ?>' data-imagebook='<?php echo  $temp['imagebook']; ?>' >send a message</button>
			 	     </div>   <?php  
			 	  }//end if
			 	   ?> </section> <br>  <?php
		}
	}  ?></div> <hr><hr> <?php
}


?>
</div>