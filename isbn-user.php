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

//$isbn=$_GET['isbn'];

if (  isset($_GET['isbn'])  ) {
	$_SESSION['isbn']=$_GET['isbn']; 
}
//echo  $_SESSION['isbn'].'<br>' ;
$isbn= $_SESSION['isbn'] ;
$isbn=trim($isbn);
$id=$_SESSION['user_id'];
$data=user($id);
$lat=$data['lat'];
$lon=$data['lon']; //echo $id.'<br>'.$lat.'<br>'.$lon.'<br>'.$isbn.'<br>';
     
$findnearestusers=findnearestuserswhohasspecifiedbooktocurrentuser($isbn,$lat,$lon,$id);//print_r($findnearestusers);
$book=book($isbn);//print_r($book);echo "<br><br>";
?> 
<div id="isbn-user-selectedbook">

        <img src=<?php echo $book['image']; ?> >
        <div><span class="a">title:</span> <span class="b"> <?php echo $book['title']; ?> </span>   </div>
        <div><span class="a">author:</span> <span class="b"> <?php echo $book['author']; ?> </span>   </div>	
        <div><span class="a">isbn:</span> <span class="b"> <?php echo $book['isbn']; ?> </span>   </div>

</div> <hr class='hr'> <div class="clear"></div>
<?php   ////  print_r($findnearestusers);echo "<br>";
//if array is empty means you are only user that has the searched book
if (empty($findnearestusers)) {
	?> <div style="font-size: 2em;font-weight: bold;color:red;text-align: center;">you are only user that has this book</div>   <?php
} else {

// Return an array containing the keys
$findnearestuserskey=(array_keys($findnearestusers));

 $struserid="(id='".implode("')or(id='",$findnearestuserskey)."')";//echo $struserid;
               $result=mysql_query("SELECT id,username,lat,lon,fname,profile_pic FROM users WHERE  $struserid  ");
            while ($row=mysql_fetch_assoc($result)) {
                 $arrayuserlatlon[]=$row;
            }
//// print_r($arrayuserlatlon);echo "<br>";
            ?> <ul id="borrowlist"> <?php
            $i=0;
foreach ($findnearestusers as $key => $value) {
	//echo $key.'<br>';
	// show only hte firsy user that has that book
	if ($i<10) {
			
	foreach ($arrayuserlatlon as $temp) {
		if ($temp['id']==$key) {
			//print_r($temp);echo "<br>".$value."<br>";
			 ?> <li class="borrowlist" > 
			 <img src="<?php echo $temp['profile_pic'] ?>" style="border-radius: 100%;float: left;" width="150" height="150" >
			       <div class="col-xs-10 col-xs-offset-0 col-sm-6 col-sm-offset-0 col-md-4 col-md-offset-0 col-lg-4 col-lg-offset-0">
			 	     <label><?php echo $temp['fname'] ?></label> <?php echo '<br>'?>
			 	     <label>Distance: <?php echo number_format($value, 3, '.', ''); ?> </label>  km<?php echo '<br>'?>
			 	    <!-- <label> <?php echo $temp['profile_pic'] ?> </label>  <?php echo '<br>'?> -->
			 	    
			 	    <!--  <textarea class="form-control" rows="2" cols="10" id="comment" placeholder="Hi <?php echo $temp['username']?>  I would like to borrow <?php echo $book['title']?>" style="max-width: 100%;"></textarea -->	
                     <a href="#" class="toggleSendMessage" style="background-color:black;color: white;text-align: center;font-size: 1.4em;padding: 4px;border-radius: 5px;"> borrow the book </a>
                     <div style="display: none;">
                     <textarea style="display:block;" class="mytext" placeholder="I would like to borrow the book,please"></textarea>
			 	     <button style="display: block;" class="btn btn-primary" name="<?php echo $temp['id']; ?>" data-idsender='<?php echo $id; ?>'
			 	     data-idrecipient='<?php echo $temp['id']; ?>'  data-idbook='<?php echo  $book['isbn']; ?>' data-title='<?php echo  $book['title']; ?>' data-imagebook='<?php echo  $book['image']; ?>' data-username='<?php echo  $temp['username']; ?>'>send a message</button>
			 	     </div>
			 	     
			 	       
			 	    </div> 
			    </li>
			    <div class="clear"></div>
			 <?php echo '<br><br><br>';
		}
	 
	}
	$i+=1;
  }// end of if $i<10	
}
           ?> </ul> <?php
?> <div id="test01"></div>
</div> 
 <?php
}// end if $findnearestusers is not empty



    
?>
