<?php
ini_set('session.save_path',getcwd().'/temp'); 
session_start();
 ob_start();
include 'connect.php';
include 'core/functions/users.php';
//function output_errors($errors)
//{return '<ul><li>'.implode('</li><li>', $errors).'</ul></li>';}
if(empty($_GET['login'])===false  ){
  $emaiorusername=trim(filter_var($_GET['emaiorusername'], FILTER_SANITIZE_STRING));
  $pass          =trim(filter_var($_GET['pass'], FILTER_SANITIZE_STRING));
  $emaiorusername = str_replace(" ", "", $emaiorusername);
  $pass = str_replace(" ", "", $pass);

  
  
  if (empty($emaiorusername) || empty($pass)) {
    $errors[]='You need to enter username/email  and password';
                                            }
        else if (user_exists($emaiorusername)===false && email_exists($emaiorusername)===false){
    $errors[]='We can\'t find that username. Have you registerd?';
    
                                          }
        else if (user_active($emaiorusername)===false) {
           $errors[]='you haven\'t activated your account!';
                                                 }
               else {
                      $login=login($emaiorusername,$pass); 
                       if($login===false) {
               $errors[]='That username/password combination is incorrect';                           
                                          }
                          else{//echo $login;
                           $_SESSION['user_id']=$login;
                           $_SESSION['security']=(int)3;
                                        
                              echo 'oksignin';
                              exit();
                              }                            
                     };
         //print_r($errors);
                           


}
if(empty($errors)===false){
  foreach ($errors as $temp) {
        echo $temp.'<br>';}

  //$login=login($emaiorusername,$pass);
  //if($login) {echo $login;} else { echo "wrong";}
  //echo $pass."###".$emaiorusername;
}







 //include 'core/init.php' ;
 //ob_start();
 //logged_in_redirect();
 //include 'includes/overall/overallheader.php';
 if(empty($_GET['register'])===false  )
 {
$username =trim(filter_var($_GET['username'], FILTER_SANITIZE_STRING));
$username = str_replace(" ", "", $username);
$password =trim( filter_var($_GET['password'], FILTER_SANITIZE_STRING));
$password = str_replace(" ", "", $password);
$password_again =trim( filter_var($_GET['password_again'], FILTER_SANITIZE_STRING));
$password_again = str_replace(" ", "", $password_again);
$email =trim( filter_var($_GET['email'], FILTER_SANITIZE_STRING));
$email = str_replace(" ", "", $email);
$firstname =trim( filter_var($_GET['firstname'], FILTER_SANITIZE_STRING));
$firstname = str_replace(" ", "", $firstname);
$address = filter_var($_GET['address'], FILTER_SANITIZE_STRING);
$lat = filter_var($_GET['lat'], FILTER_SANITIZE_STRING);
$lon = filter_var($_GET['lon'], FILTER_SANITIZE_STRING);
 	
 	if(empty($username) ||empty($password)||empty($password_again)||empty($email) ||empty($address)||empty($lat)||empty($lon) || empty($firstname)) 
 	{
 		$errors[]='fields marked with asterisk are requierd';//echo 'fields marked with asterisk are requierd';
 	} ;
 	      if (empty($address)||empty($lat)||empty($lon)) {
           $errors[]='plz click the button of find address to confirm your address';
         }  
         if (!empty($username)) {
           
         if( (user_exists($username)===true)  )
 	    	 {
 	    		$errors[]='Sorry, the username \''.$_GET['username'].'\' is already taken';
 	    	 }; }
 	    	
 	    	 if (preg_match("/\\s/", $username)==true)
 	    	    {
 	    		$errors[]='Your Username must not contain any space';
 	    	    };
 	    	    if (strlen($password)<0 || strlen($password)>15) 
 	    	         {
 	    	      	   $errors[]='Your password must be betwwen 6 till 15 characters';
 	    	         };
 	    	           	if ($password !==$password_again) 
 	    	           	{
 	    	           		$errors[]='Your password do not match';
 	    	           	};
                          if (!empty($username)) {
                          if (!(filter_var($email,FILTER_VALIDATE_EMAIL)))
                           {
                          	$errors[]='A valid email is requierd';
                           };
                            if (email_exists($email)===true)
                              {
                            	$errors[]='Sorry, the email \''.$_GET['email'].'\' is already in use';
                              }
                            }
                            };
 	    	           	 

if ((empty($_GET['register'])===false)&&empty($errors)===true)
 {
	
	$email_code=md5($_GET['username']+microtime());
	$register_data=array($username,$password,$email,$email_code,$firstname,$address,$lat,$lon);

    register_user($register_data);echo "ok";
    //header('Location: http://localhost/LIBRARY/lib/signin.php');
   // header("Refresh:0; url=signin.php ");
    exit();

 } 
 else 
    if ((empty($_GET['register'])===false)&&empty($errors)===false)
	# code...
    { 
    	foreach ($errors as $temp) {
    		echo $temp.'<br>';
    	}
	//echo output_errors($errors);
    }
?>


<?php

         
