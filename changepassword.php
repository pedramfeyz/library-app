<?php
include 'connect.php';
include 'core/functions/users.php'; 
ini_set('session.save_path',getcwd().'/temp'); 
session_start();
ob_start();
protect_page();
$id=$_SESSION['user_id'];
$data=user($id);

//old pass
if (isset($_GET['oldpass'])) {

	

	$oldpass=mysql_real_escape_string($_GET['oldpass']);
	if (password_match($id,$oldpass)===false){
		$i=(--$_SESSION['security']);
		if($_SESSION['security']<=0){echo "refresh";;exit();}else{};
		echo "Password is not correct.";
		echo 	'you can only try '.$i.' more';
		

	}else{ echo "ok";

	}

}// end of if (isset($_GET['oldpass']))


// new pass
if ( isset($_GET['newpass01']) && isset($_GET['newpass02']) ) {

	$newpass01=mysql_real_escape_string($_GET['newpass01']);
	$newpass02=mysql_real_escape_string($_GET['newpass02']);

	if ($newpass01 !== $newpass02) {
		 echo	'Your password do not match';
	} else {
			if (strlen($newpass01)<2 || strlen($newpass01)>15) 
	 	    	         {
	 	    	      	   echo 'Your password must be betwwen 2 till 15 characters';
	 	    	         } else{
	 	    	         	update_password($id,$newpass01);
	 	    	         	$_SESSION['security']=(int)3;
 	    	                     	echo "password changed";
	 	    	         }
	}
	
}
?>