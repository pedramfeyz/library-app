<?php 
include 'connect.php';
include 'core/functions/users.php';    
ini_set('session.save_path',getcwd().'/temp'); 
session_start();
ob_start();
protect_page();include 'includes/overall/overallheadr.php';
$id=$_SESSION['user_id'];
$data=user($id);
$lat=$data['lat'];
$lon=$data['lon'];    //echo $id.'<br>'.$lat.'<br>'.$lon.'<br>';
//print_r($data);
include 'includes/overall/header.php';
$arrayfinalfindbook=findbooksnearme($id,$lat,$lon);
 
?>

<div class="container">
<?php
 $counter=0;
 $selectallbooks=selectallbooks();
         	//print_r($selectallbooks);
                     ?><br><ul id="ul_findbooksnearme"><?php
         	foreach ($arrayfinalfindbook as  $value) {
         		$counter+=1;
         		foreach ($selectallbooks as  $temp) {
         		if ($temp['isbn']==$value[1]) {
         			?> 
                    <div class="col-xs-8 col-xs-offset-2 col-sm-4 col-sm-offset-0">
                  <li class="showallbooksnearme " >

                         <div> 
                             <img src="<?php echo $temp['image'] ?>" style="border-radius: 7px;width: 128px;
      height: 201px;" > 
                         </div>  

                         <div style="max-width:200px; word-wrap:break-word;">
                            <p><span>title:</span> <?php  echo $temp['title'] ?> </p>
                            <p><span>author:</span> <?php  echo $temp['author'] ?> </p>
                            <p><span>isbn:</span> <?php  echo $temp['isbn'] ?> </p>
                         </div>

                         <div>
                            <button class="btn btn-primary" name=" <?php echo $temp['isbn'] ?> ">Click here</button> <!-- isbn -->
                         </div>
                  
                   </li></div> <?php if (($counter % 3)==0) {
                                          ?>  <div class="clear"></div> <?php
                                           }
         			
         		} 
         	}
         	
         	}
          ?></ul> <?php  //; echo "uesr-id:".$value[0]
?>

<?php include 'includes/overall/overallfooter.php'?>
</div>