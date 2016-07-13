<?php 
include 'core/functions/users.php';
require 'connect.php';
ini_set('session.save_path',getcwd().'/temp'); 
session_start();
ob_start();
protect_page();
//echo getcwd();
$user_id=$_SESSION['user_id'];
//echo $user_id;
 
//getcwd(): 'C:\wamp\www\library\lib';
if (empty($_GET['isbn10'])==true) {
    echo "Sorry,we can't add this book because its ISBN isn't standard  ";
}
else {
$title=$_GET['title'];
$authors=$_GET['authors'];
$publishedDate=$_GET['publishedDate'];
$isbn10=$_GET['isbn10'];
$isbn13=$_GET['isbn13'];
$language=$_GET['language'];
$smallThumbnail=$_GET['smallThumbnail'];   
$mix=$title.','.$authors.','.$isbn10.','.$isbn13;    
///echo $title.'<br>'.$authors.'<br>'.$publishedDate.'<br>'.$isbn10.'<br>'.$isbn13.'<br>'.$language.'<br>';
addbook($user_id,$isbn10,$title,$authors,$mix,$isbn10,$isbn13,$publishedDate,$language,$smallThumbnail);
}

  /* users.php
  function save($data,$addressfile){
    $json =json_encode($data);
    $file =fopen($addressfile, "w");
    fwrite($file, $json);
}*/
function loadimageofbook($smallThumbnail){
//$url='http://books.google.com.au/books/content?id=vlr0uqedlWcC&printsec=frontcover&img=1&zoom=5&edge=curl&source=gbs_api';

$filenameOut ='book/images/'.substr(md5(time()), 0,10).'.jpg';

$contentOrFalseOnFailure   = file_get_contents($smallThumbnail);
$byteCountOrFalseOnFailure = file_put_contents($filenameOut, $contentOrFalseOnFailure);

return $filenameOut;
}

function addbook($user_id,$isbnbook,$title,$authors,$mix,$isbn10,$isbn13,$publishedDate,$language,$smallThumbnail){
    
         
         $json = file_get_contents('user-isbn.json');
         $arrayData= json_decode($json,true);
         if (  in_array($isbnbook, $arrayData[$user_id]) ) {echo "you alredy add this book";}
          else{
         $arrayData[$user_id][]         = $isbnbook;
         save($arrayData,'user-isbn.json');//echo "the book added to your shelf,user-isbn<br>";

          $json = file_get_contents('isbn-user.json');
         $arrayData= json_decode($json,true);
          $arrayData[$isbnbook][]         = $user_id;
         save($arrayData,'isbn-user.json');//echo "the book added to your isbn-user<br>";


         $query="SELECT isbn FROM libbook WHERE isbn='$isbnbook'";
    $result=mysql_query($query);
    // check if that book  exist in libbook or not
    if (mysql_num_rows($result)==0) {
          
          if (empty($smallThumbnail)) { $imageaddress='book/images/bookcover.jpg';
              
          }else{
                 $imageaddress=loadimageofbook($smallThumbnail)   ; 
          }
         
         
         $query="INSERT INTO libbook (isbn,title,author,mix,isbn_10,isbn_13,publishedDate,language,image) VALUES ('$isbnbook','$title','$authors','$mix','$isbn10','$isbn13','$publishedDate','$language','$imageaddress')";
         mysql_query($query);
         echo "the book added to your shelf, Thanks for add new book to our library";
    } else {   echo "the book added to your shelf";   }


     }
 }  
?>