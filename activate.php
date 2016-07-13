<?php 
include 'connect.php';
include 'core/functions/users.php';
ob_start();

if(isset($_GET['email'],$_GET['email_code']))
  {
     $email     =trim($_GET['email']);
     $email_code=trim($_GET['email_code']);

     if(email_exists($email)===false)
        {
          $errors[]='Oops,we could\'nt find that email address';echo $email;echo '<>'.$email_code;
        }
        else if(activate($email,$email_code)===false)
             {
              $errors[]='We had problems activating your account';
             }else {echo 'Your account has been activated successfully';
                       header( "refresh:5;url=signin.php" );exit();}

  }   else
       {
         //header('Location:index.php');
         exit();
       }

 if (empty($errors)===false)
	# code...
    {
	echo output_errors($errors);
    }

?>  