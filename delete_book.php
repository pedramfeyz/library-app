 <?php
include 'connect.php';
include 'core/functions/users.php'; 
ini_set('session.save_path',getcwd().'/temp'); 
session_start();
ob_start();
protect_page();
$id=$_SESSION['user_id'];
$data=user($id);


if (isset($_GET['isbn'])) {
	$isbn=mysql_real_escape_string($_GET['isbn']);
	
	// delete from user-isbn 
	$json = file_get_contents('user-isbn.json');
    $arrayData= json_decode($json,true);
   // print_r($arrayData[$id]);
       // remove $isbn from the array of user-isbn
       foreach ($arrayData[$id] as $temp) {
	        if ($temp!=$isbn) {
		    $newarrayData[$id][]=$temp;
			       }//end of if
             }//end of foreach

$arrayData[$id]=$newarrayData[$id];
//echo '<br>';print_r($arrayData[$id]);
save($arrayData,'user-isbn.json');

   //####### end

  // delete user-id from isbn-user
    $json = file_get_contents('isbn-user.json');
    $arrayData= json_decode($json,true);
  //  print_r($arrayData[$isbn]); 
    // remove  user from the array  isbn-user
       foreach ($arrayData[$isbn] as $temp) {
	        if ($temp!=$id) {
		    $newarrayData[$isbn][]=$temp;
			       }//end of if
             }//end of foreach

$arrayData[$isbn]=$newarrayData[$isbn];
if (empty($arrayData[$isbn]) ) { //if no user has this book anymore then remove from libbook databse as well
	$result=mysql_query("SELECT image From libbook WHERE isbn='$isbn' ");
	$result=mysql_result($result,0);
	// remove the image from databaase (if it has it's cover)
	if ($result!='book/images/bookcover.jpg') {
		unlink($result);
	}
	
	mysql_query("DELETE FROM libbook WHERE isbn='$isbn'");
} 

//echo '<br>';print_r($arrayData[$isbn]);
save($arrayData,'isbn-user.json');
echo "the book deleted";
   




}
?>