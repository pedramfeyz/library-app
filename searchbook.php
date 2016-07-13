<?php
require 'connect.php';


$str=filter_var($_GET['book'], FILTER_SANITIZE_STRING);
$str=mb_strtoupper($str, 'UTF-8');
$str1= '/'.$str.'/' ;
// select the intended book from database based on what user type in searchbox
function searchbook(){
	$query="SELECT isbn,mix FROM libbook";
	$result=mysql_query($query);
	if(mysql_num_rows($result)>0){
	while($row=mysql_fetch_assoc($result) ) {
	$arrayisbn[]=$row;
	}
  } //print_r($arrayisbn);//echo $arrayisbn;
  return $arrayisbn;
  }

// compare $srt to mix
function compare($str,$arrayisbn){

  foreach ($arrayisbn as $temp) {
    
      $book=$temp[mix];
      $book=mb_strtoupper($book, 'UTF-8');
      $isbn=$temp[isbn];

  	if( preg_match($str,$book) ) {$a=20;}else {$a=0;}; 
       similar_text($str,$book,$percent);
       $percent=($a+$percent);
       $arraypercentage[$isbn]['percent']=$percent;
       $arraypercentage[$isbn]['mix']=$book;
       $arraypercentage[$isbn]['isbn']=$isbn;

}    return $arraypercentage;
   }


    function sortById($x, $y) {
    return $y['percent'] - $x['percent'];
}

$arrayisbn=searchbook();//echo $arrayisbn[0][isbn];echo $arrayisbn[0][mix].'<br>';echo count($arrayisbn);
$arraypercentage=compare($str1,$arrayisbn);
usort($arraypercentage, 'sortById'); $i=1;//print_r($arraypercentage);
?>  <ul id="findbooks" > 
        <?php
          foreach ($arraypercentage as $temp) {
                if($i>6) break;$i=$i+1;//just send 6 first elment of array
                                 //   echo $temp['mix'].'percentage:'.$temp['percent']; // <a href="isbn-user.php">
              ?>  
              <button class="btnfindbook list-group-item"  id="selectbook<?php echo $i  ?>" name="<?php echo $temp['isbn']  ?>"><?php echo $temp['mix']  ?></button>
              <?php
            };
       ?>
     </ul>


  <!--  {
     ?> <div> 
     <?php    if($i>6) break;$i=$i+1;//just send 6 first elment of array
   //   echo $temp['mix'].'percentage:'.$temp['percent']; // <a href="isbn-user.php">
      ?>  
      <button class="btnfindbook list-group-item"  id="selectbook<?php echo $i  ?>" name="<?php echo $temp['isbn']  ?>"><?php echo $temp['mix']  ?></button>
      </div>
      <?php ?>
      
    }; -->
    