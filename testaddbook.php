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
<br>
  <form id="formtest" class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
    <input id="isbntest" name="isbn" type="text" class="form-control" placeholder="isbn or title*">
  <!--  <input id="title" type="text" class="form-control" placeholder="title*">
    <input id="author" type="text" class="form-control" placeholder="author*">  -->
  </form>
  <br><br>
  <button id="btnaddbooktest"  class="btn btn-primary col-xs-8 col-xs-offset-2 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">Search the book to add</button>
    <div id="txt"></div>
    
  
  
    <?php /* 
      */
      if (  isset($_GET['dt']) && !empty($_GET['dt']) ) {
      $data=$_GET['dt'];
      $data = str_replace(" ", "%20", $data);//  echo $data;
      $str = file_get_contents('https://www.googleapis.com/books/v1/volumes?q='.$data);//.victor.'%20'.hogo
        $json = json_decode($str, true);
        $totalItems=$json['totalItems'];//the numbers of book that has found
        if($totalItems==0){
          $i=0;
          echo "Sorry ,we couldn't find that book,plz try again";
        }
          // show max 10 book
        else if ($totalItems<=10) {
          $i=$totalItems;
        } else if ($totalItems>10) {
            $i=10;
        }
            ?>
              <div class="clear"></div>
             <ul id="addbooklist"> <?php  echo "<br><br>";
        for($x=0; $x<$i; $x++){
                 
               $isbn10=(string)$json['items'][$x]['volumeInfo']['industryIdentifiers'][0]['identifier'];
             ?> 
             
             <li class="addbooklist" >
             <div class="col-sm-12 col-md-6 col-lg-4">
                   <div style="margin: 15px; height:200px;">

               <div style="display: inline;margin-right: 15px;max-width: 150px">
                <img width="150px" height="200px" src="<?php  echo   $json['items'][$x]['volumeInfo']['imageLinks']['thumbnail']?>">
               </div>
               <div style="color: black;display:inline;position:absolute;max-width: 200px;" >
               <form id="<?php  echo  $isbn10 ?>">

                 <p><span>title: </span><?php  echo   $json['items'][$x]['volumeInfo']['title']?></p>
                 <p><span>author: </span><?php  echo   $json['items'][$x]['volumeInfo']['authors'][0] ?></p>
                 <p><span>published date: </span><?php  echo   $json['items'][$x]['volumeInfo']['publishedDate']?></p>
                 <p><span>ISBN_10: </span><?php  echo   $json['items'][$x]['volumeInfo']['industryIdentifiers'][0]['identifier']?></p>
                 <p><span>ISBN_13: </span><?php  echo   $json['items'][$x]['volumeInfo']['industryIdentifiers'][1]['identifier']?></p>
                 <p><span>language: </span><?php  echo   $json['items'][$x]['volumeInfo']['language']?></p>
                <!-- <p><span>smallThumbnail: </span><?php  echo   $json['items'][$x]['volumeInfo']['imageLinks']['smallThumbnail']?></p> -->

                 <input class="inputaddbooklisthidden" name="title" type="text" value="<?php  echo   $json['items'][$x]['volumeInfo']['title']?>">
                 <input class="inputaddbooklisthidden" name="authors" type="text" value="<?php  echo   $json['items'][$x]['volumeInfo']['authors'][0]?>">
                 <input class="inputaddbooklisthidden" name="publishedDate" type="text" value="<?php  echo   $json['items'][$x]['volumeInfo']['publishedDate']?>">
                 <input class="inputaddbooklisthidden" name="isbn10" type="text" value="<?php  echo   $json['items'][$x]['volumeInfo']['industryIdentifiers'][0]['identifier']?>">
                 <input class="inputaddbooklisthidden" name="isbn13" type="text" value="<?php  echo  $json['items'][$x]['volumeInfo']['industryIdentifiers'][1]['identifier']?>">
                 <input class="inputaddbooklisthidden" name="language" type="text" value="<?php  echo   $json['items'][$x]['volumeInfo']['language']?>">
                 <input class="inputaddbooklisthidden" name="smallThumbnail" type="text" value="<?php  echo   $json['items'][$x]['volumeInfo']['imageLinks']['smallThumbnail']?>">

               </form>

               </div>
               </div>

             <button style="margin-bottom: 50px;margin-left:15px;" class="btn btn-primary" name="<?php  echo $isbn10 ?>" data-idsender='<?php ?>'
             data-idrecipient='<?php  ?>'  data-idbook='<?php ?>' data-username='<?php  ?>'> Add this book </button>
               
            </div> 
          </li>
          
       <?php 


          
        }

        
     } 
    
    ?>
    
 

<?php include 'includes\overall/overallfooter.php'?>
</div>
