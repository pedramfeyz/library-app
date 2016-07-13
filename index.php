<?php include 'includes/overall/overallheadr.php'?>  
	<div class="container">
	<header id='mainheader'>
		<h2 id='greeting' class='fontpacifico'>Hi everybody</h2>
		<div id="signmain" class="sign">
		<a href='signin.php'><button id="btnsignin" class="btn btn-primary btn-md">Sign in</button></a><br>
		<h6>New User?<a href="#" id="direction_to_register" >click here to register new account</a></h6>
		</div>
	</header>

		<img src="css/pic/1024px-bookshelf.jpg" class="  col-xs-12" style="height: 150px; margin-top:20px ;border-radius: 100px;">
		
		
		 
        		
    <div id="headersearchbook" class="col-xs-12 col-sm-8 col-md-8 col-lg-6 col-lg-offset-3 col-md-offset-2 col-sm-offset-2 ">
    <label style="display:block;text-align:center;margin-top:15px">Search a book to borrow</label>
    <div class="input">
   <input id="searchbook" name="searchbook" type="text" class="form-control" placeholder="enter title or author or isbn for search a book" >
   </div>
   <div id="searchlist" class="list-group" style="display: block; width:100%;text-align:center;">
	</div>
    </div>
   

		<div id="search" class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-sm-offset-3" style="text-align: center; ">
		<br><br><br><br>
		<label>Would you like to see the books near you?</label><br>
	
		<button  name="btnfindbooksnearme" class="btn btn-primary btn-lg" onclick="getLocation()">find books near me</button>
     

<p id="demo"></p>



<script>
var x = document.getElementById("demo");

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else { 
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}

function showPosition(position) {
    x.innerHTML = "Latitude: " + position.coords.latitude + 
    "<br>Longitude: " + position.coords.longitude;
      var lat=position.coords.latitude;
    var lon=position.coords.longitude;
      window.location.href = "findbooksnearme-notlogged.php?lat=" + lat + "&lon=" + lon;
}
</script>

		</div>
		
<div class="clear()"></div>
<?php include 'slider.php' ?>    
	</div>



