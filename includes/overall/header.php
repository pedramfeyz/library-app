<script type="text/javascript">


/*setInterval(function(){ 
   $("#alarmNewMessage").click();
},3000);*/
  
 $(function(){

      $.ajax({
        url:'checknewmsg.php',
        success:function(data){
           // alert(data);
            if (data>0) {
           $('#alarmNewMessage').text(data);
            $('#alarmNewMessage').css("background-color", "red");
            $('#alarmNewMessage').next().css("display", "inline-block");

         }
        }
      })
    })

  setInterval(function(){ 
    $(function(){

      $.ajax({
        url:'checknewmsg.php',
        success:function(data){
           // alert(data);
            if (data>0) {
           $('#alarmNewMessage').text(data);
            $('#alarmNewMessage').css("background-color", "red");
            $('#alarmNewMessage').next().css("display", "inline-block");
         }
        }
      })
    })

              }, 3000);  

</script>
<header id="headerloggedin">
  <div id="headerloggedin_background" style="" class="col-xs-12"></div> 

<div id="profile"  style="float: right;display: inline-block;padding-top: 0px;margin-top: 10px;margin-right: 20px;">
  <div >
         

        <ul style="list-style-type: none;margin-right:10px;">

       <li style="display: inline-block;">
         <h3 style="margin-top: 0px;position: absolute;top:48px;right:263px ;text-align:right;width: 90px; height: 35px;word-wrap: break-word;"> <?php echo $data['fname'] ?> </h3>
        </li>

         <li style="display: inline-block;">
        <button style="width:100%;height:34px;text-align:center;" id="alarmNewMessage" class="btn btn-primary btn-md fa fa-envelope" ></button>
        <button style="position: absolute;display: none;border-radius: 25px;opacity: .3;">new message</button>
        </li>


        <li style="display: inline-block;">
        <div class="span2" style="text-align: center;">
            <div class="btn-group">
                <a class="btn dropdown-toggle btn-info btn-sm" data-toggle="dropdown" href="#" style="padding:7px ">
                    Action 
                    <span class="icon-cog icon-white"></span><span class="caret"></span>
                </a>
                <ul class="dropdown-menu" width:'50px'>
                    <li><a href="logout.php"><span class="icon-wrench fa fa-sign-out"></span> Log out</a></li>
                    <li><a href="loggedin.php"><span class="icon-wrench fa fa-home fa-fw"></span> Main page</a></li>
                    <li><a href="shelf_book.php"><span class="icon-wrench fa fa-book fa-fw"></span> My bookshelf</a></li>
                    <li><a href="testaddbook.php"><span class="icon-wrench fa fa-book"></span> Add book</a></li>
                    <li><a href="editprofile.php"><span class="icon-trash fa fa-cog fa-fw"></span>Settings</a></li>
                </ul>
            </div>
        </div> 
        </li>


        <li style="display: inline-block;">
        <img src="<?php echo $data['profile_pic']?>" class="img-circle" style="height: 100px;width: 100px;">
        </li>

        </ul>


     
  </div>
</div>


 <div id="" style="padding-top: 25px;" >
    <div id="headersearchbook" class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-lg-offset-4 col-md-offset-2 col-sm-offset-1 ">
    <div class="input">
   <!-- <label>find a book</label>  -->
  <input id="searchbook" name="searchbook" type="text" class="form-control" placeholder="enter title or author or isbn for search a book" >
   </div>
   <div id="searchlist" class="list-group" style="display: block;">
  <!--  <a class="list-group-item" href="blue.html"><span>blue</span></a> -->
  </div>
    </div>
    </div>
      
</header>






