<?php include 'includes/overall/overallheadr.php';
require 'includes/functions/function.php';

?>
<a name="topofpage"></a>
<div class="container">


	<header id='mainheader'>
		<h2 id='greeting' class='fontpacifico'>Hi everybody</h2>
	</header>

		<img src="css/pic/1024px-bookshelf.jpg" class="  col-xs-12" style="height: 150px; margin-top:20px ;border-radius: 100px;">


<form id='signinform' class='col-xs-12 col-sm-8 col-sm-offset-2  col-md-6 col-md-offset-3' style="text-align:center;">
<div id="textsuccessforregister"></div>
<h2>Sign in</h2>
<h4 id="text_error_signin" style="color: red;border: 1px solid lightblue;border-radius: 5px;"></h4>
<label>Email or username </label>
<input id="emaiorusername" name="emaiorusername" class='form-control'></input>
<label>Password</label>
<input id="pass" name="pass" class='form-control' type="password"></input>
<br>
<button id="btnsignin" class='btn btn-primary btn-md' >log in</button>
<br>
<a href="forgotten_pass.php" style="font-size: .8em;margin-left: 10px;">forgotten your password?</a>
<hr class='hr'>
<h6><label>if you are new user ,please make an account</label></h6>
<button id='btnsignup' class='btn btn-warning'>Create new account</button>
</form>

<form id='signupform' class='col-xs-12 col-sm-8 col-sm-offset-2  col-md-6 col-md-offset-3' style="text-align:center;">
<h2>Register</h2>
<div id="errortext" style="color: red;border: 1px solid lightblue; border-radius: 5px;"></div>
<hr><h6>The address is neccessary to find nearest useres to you for borrow or lend book</h6>
<label>Address*</label>
<input id="adrs-st" class="form-control" placeholder="plz enter strret *"></input>
<input id="adrs-ct" class="form-control" placeholder="plz enter city *"></input>
<input id="adrs-cr" class="form-control" placeholder="plz enter country *"></input>
	<br>
	<div id="txt"></div>
<button id="btn-search" class='btn btn-primary btn-xs' style="float:right">find address</button>

<br class='clear'>
<label>uesrname*</label>
<input id="username" name="username" class='form-control'></input>
<label>Email*</label>
<input id="email" name="email" class='form-control' type="Email"></input>
<label>Password*</label>
<input id="password" name="password" class='form-control' type="password"></input>
<label>Password again*</label>
<input id="password_again" name="password_again" class='form-control' type="password"></input>
<label>first name*</label>
<input id="firstname" name="firstname" class='form-control'></input>
<a id="gototopofthepage" href="#topofpage"></a>

<br>

<button id='btnregister' class='btn btn-warning'>Register </button>
<hr class='hr'><br>
<h5>Already have an account?<a id="signin" href='signin.php' style="">sign in</a></h5>
</form>
</div>
<script type="text/javascript">
	$(function(){

		$('#btnsignin').on('click',function(event){
			event.preventDefault();
			var dt=$('#signinform').serialize();
			$.ajax({
				type:'GET',
				url:'register.php?login=login',
				data:dt,
				success:function(data){
					 var str = $.trim(data);
					
					if (str=='oksignin'){
						window.location.href = "loggedin.php";
					} 
                     else {
                           $('#text_error_signin').html(data);
                     }
                       
				}

			})


		})





		$('#btnregister').on('click',function(event){
			event.preventDefault();
			var dt=$('#signupform').serialize();
			$.ajax({
				type:'GET',
				url:'register.php?register=register',
				data:dt,
				success:function(data){
					 var str = $.trim(data);
					
					if (str=='ok') {//alert(str);
									$("#signupform").slideUp();
					                $('#signupform').css({display:'none'});
					                $("#signinform").slideDown(500);//$('#sign in')[0].click(); 
					                $('#textsuccessforregister').html('Check Your Email To Activate Your Account!<br>You have successfully created your account! To begin using this site you will need to activate your account via the email we have just sent to your address. ');
					                  $('#gototopofthepage')[0].click();
					                  $('#adrs-st').val('');$('#adrs-ct').val('');$('#adrs-cr').val('');$('#errortext').html('');$('#txt').html('');        
					                  $('#username').val(''); $('#password').val('');$('#password_again').val('');$('#email').val('');$('#firstname').val('');
		                 

									} else {
					                  $('#errortext').html(data);
					                $('#gototopofthepage')[0].click(); // $('#goup')[0].trigger('click');
					                
								           }
			}//end function success
		  })
        })//end #btnregister click
	})
</script>


<?php
if (isset($_GET['register'])) {
	//header("Location: http://localhost/LIB/signin.php");
	?> <script type="text/javascript">
	$(function () {
     $("#signinform").slideUp(1);
     $('#signupform').css({display:'block'});
  })
</script>
<?php
}
?>
<?php include 'includes/overall/overallfooter.php'?>
