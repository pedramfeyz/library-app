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

 $json = file_get_contents('user-isbn.json');
 $arrayData= json_decode($json,true);
 //print_r($arrayData[$id]);
 if (empty($arrayData[$id])) {
 	?> <div style="color: red;text-align: center;font-weight: bold;font-size: 2em;">  <?php echo "you don't have any book in your bookshelf"; ?> </div> <?php
 } else {
 $str_isbn="(isbn='".implode("')or(isbn='",$arrayData[$id])."')";
// echo $str_isbn;
 $result=mysql_query("SELECT * FROM libbook WHERE  $str_isbn");
        while ($row=mysql_fetch_assoc($result)) {
             $array_book[]=$row;
        }
        ?> <ul id="ul_shelf_book" style="text-decoration: none"> <?php
        $counter=0;
        foreach ($array_book as $temp) {
        	$counter+=1;
        	?> <li class="col-xs-10 col-sm-4 col-lg-4 ;"> 
        <img src=<?php echo $temp['image']; ?>  style="width: 128px;
      height: 201px;">
        <div><span class="a">title:</span> <span class="b"> <?php echo $temp['title']; ?> </span>   </div>
        <div><span class="a">author:</span> <span class="b"> <?php echo $temp['author']; ?> </span>   </div>	
        <div><span class="a">isbn:</span> <span class="b"> <?php echo $temp['isbn']; ?> </span>   </div>
        <button data-isbn=<?php echo $temp['isbn']; ?> class="btn btn-primary">delete</button>

        <?php  //	print_r($temp);echo '<br>';
        	
        	
        	//echo $title.'<br>'.$author.'<br>'.$isbn.'<br>'.$image.'<br><br><br>';

        	?> </li>  <?php  if (($counter % 3)==0) {
                                          ?>  <div class="clear"></div> <?php
                                           } // end of if
        } //end of foreach
        ?> </ul> <?php
    }//end of else

?>


</div>