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

 <form action="" method="post" enctype="multipart/form-data">
	<input type="file" name="profile" accept="image/png, image/gif, image/jpeg, image/jpg"></input>
	<input type="submit"></input>
</form>



<?php 
if (isset($_FILES['profile'])) {
	if (empty($_FILES['profile']['name'])) {
		echo "please choose a file";
	} else {
		$allowed=array('jpg','jpeg','gif','png');
 echo $_FILES['profile']['size'];
		$file_name=$_FILES['profile']['name'];
		$file_extn=strtolower(end(explode('.', $file_name)));
		$file_temp=$_FILES['profile']['tmp_name'];
echo  $file_temp;
		if (in_array($file_extn, $allowed)) {
			// uploas=d file
			$id=1;
			change_profile_image($id, $file_temp,$file_extn);//$session_user_id
		}else{
			echo "Incorrecy file type. Allowed: ";
			echo implode(', ', $allowed);
		}

	}
}  
?>



<?php
function  change_profile_image($id, $file_temp,$file_extn){
	$file_path='images/profile/'.substr(md5(time()), 0,10).'.'.$file_extn;
	echo '<br>'.$file_path;
	move_uploaded_file($file_temp, $file_path);

	//mysql_query("UPDATE  ");// UPDATE $file_path
}


?>
 

<?php include 'includes/overall/overallfooter.php'?>
</div>



