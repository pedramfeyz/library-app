<?php include 'connect.php';
include 'core/functions/users.php';


if (isset($_GET['email'])) {
	$email=mysql_real_escape_string($_GET['email']);
	$email=strip_tags($email);
	if (email_exists($email)) {
                    $user_data=user_data(user_id_from_email($email),'id','fname','username');
	            	$generated_password=substr(md5(rand(999,999999)),0,8);
                    update_password($user_data['id'],$generated_password);
                    email($email,'Your password',"Helllo " .$user_data['fname']. ",\n\nYour password is: " .$generated_password. "  ");
                 //   echo $generated_password;
                    echo "ok";
	


	}else{
		echo "We couldn't find that email address between our users";
	}
	exit();
}
include 'includes/overall/overallheadr.php';
?>  





	<div class="container">
	<header id='mainheader'>
		<h2 id='greeting' class='fontpacifico'>Hi everybody</h2>
		<div id="signmain" class="sign">
		<a href='signin.php'><button id="btnsignin" class="btn btn-primary btn-md">Sign in</button></a><br>
		<h6>New User?<a href="#" id="direction_to_register" >click here to register new account</a></h6>
		</div>
	</header>

		<img src="css/pic/1024px-bookshelf.jpg" class="  col-xs-12" style="height: 150px; margin-top:20px ;border-radius: 100px;">
		


         <div class='col-lg-6 col-lg-offset-3' style="margin-top:5em;text-align:center;">
         <h1 style="color:red">Have you forgotten your password ?</h1>
		<input id='input_forgotten_pass' type="text" placeholder='Please enter your email to reset your password' class='form-control' style="ma" />
		<button id='btn_forgotten_pass' class='btn btn-primary' style="margin-top: 1em;" >Reset password</button>
		<p id='txt_forgotten_pass' style="color:red;"></p>
		</div>


		<script>

		$(function (){

			$('#btn_forgotten_pass').on('click',function(e){
				e.preventDefault();
				$('#txt_forgotten_pass').css({'color':'red'});
				$('#txt_forgotten_pass') .text('');
				var email=$('#input_forgotten_pass').val();
				    email=$.trim(email);
				    if (email.length>0) {
				    	if (validateEmail(email)) {
				    	
				    	$.ajax({
				    		type:'GET',
				    		url:'forgotten_pass.php',
				    		data:{email:email},
				    		success:function (data){
				    			if (data=='ok') {  $('#txt_forgotten_pass').css({'color':'green'});
				    			                   $('#txt_forgotten_pass') .text('your password successfully reset, please check your email');
				    			 } else {$('#txt_forgotten_pass') .text(data);}
                                  
				    		}
				    	}) // end of ajax


				    	$('#input_forgotten_pass').val('');
				    }else{
                        $('#txt_forgotten_pass') .text('Your email address is not correct,your email address must be include @,.,so on');
				    }// end of else validate
				    }// end of if email.length>0		
			})


			function validateEmail(sEmail) {
var filter = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
if (filter.test(sEmail)) {
return true;
}
else {
return false;
}
}

		})//end of $(function ()


		</script>


	</div>