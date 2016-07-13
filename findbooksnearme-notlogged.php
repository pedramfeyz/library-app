<?php 
include 'connect.php';
include 'core/functions/users.php'; 
include 'includes/overall/overallheadr.php'; ?>
   <div class="container">
   <header id='mainheader'>
      <h2 id='greeting' class='fontpacifico'>Hi everybody</h2>
      <div id="signmain" class="sign">
      <a href='signin.php'><button id="btnsignin" class="btn btn-primary btn-md">Sign in</button></a><br>
      <h6>New User?<a href="#">click here to register new account</a></h6>
      </div>
   </header>

      <img src="css/pic/1024px-bookshelf.jpg" class="  col-xs-12" style="height: 150px; margin-top:20px ;border-radius: 100px;">



<?php

 if (  isset($_GET['lat']) && isset($_GET['lon']) ) {

//print_r($data);
$lat=$_GET['lat'];
$lon=$_GET['lon'];
  //echo $lat.'<br>'.$lon.'<br>';
$arrayfinalfindbook=findbooksnearme(0,$lat,$lon);
?>

<?php

 $counter=0;
 $selectallbooks=selectallbooks();
            //print_r($selectallbooks);
                     ?>
                      <p style="clear:left;"></p><hr>
                    <br> <ul id="ul_findbooksnearme_notlogged"><?php
            foreach ($arrayfinalfindbook as  $value) {
               $counter+=1;
               foreach ($selectallbooks as  $temp) {
               if ($temp['isbn']==$value[1]) {
                  ?> 
                    <div class="col-xs-8 col-xs-offset-2 col-sm-4 col-sm-offset-0">
                  <li class="showallbooksnearme " >

                         <div> 
                             <img style="width: 128px;
      height: 201px;" src="<?php echo $temp['image'] ?>" > 
                         </div>  

                         <div style="max-width:200px; word-wrap:break-word;">
                            <p><span>title:</span> <?php  echo $temp['title'] ?> </p>
                            <p><span>author:</span> <?php  echo $temp['author'] ?> </p>
                            <p><span>isbn:</span> <?php  echo $temp['isbn'] ?> </p>
                         </div>

                         <div>
                            <a href="signin.php"><button class="btn btn-primary" name=" <?php echo $value[0] ?> ">Click here</button></a> <!-- isbn -->
                         </div>
                  
                   </li></div> <?php if (($counter % 3)==0) {
                                          ?>  <div class="clear"></div> <?php
                                           }
                  
               } 
            }
            
            }
          ?></ul> <?php  //; echo "uesr-id:".$value[0]




}//end if
?>

<?php include 'includes\overall/overallfooter.php'?>
</div>

