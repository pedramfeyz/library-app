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

// update name
if(isset($_GET['name'])){
	$name=mysql_real_escape_string($_GET['name']);
	$change_name=change_name($name,$id);
	echo $change_name;
	}

	// update the address
	if (isset($_GET['lat']) && isset($_GET['lon']) && isset($_GET['address'])) {

		$lat=mysql_real_escape_string($_GET['lat']);
		$lon=mysql_real_escape_string($_GET['lon']);
		$address=mysql_real_escape_string($_GET['address']);
		$change_address=change_address($lat,$lon,$address,$id);

		echo $change_address;
	}


?> 