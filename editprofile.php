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
<div>
	<ul id="editsettings">
		<li id="editname" data-edit="editname01" class="editsettings">Edit: Name</li>
		<div id="editname01" class="editdivsetttings" style="display: none;">
            <p id="edit_name_text" style="display: none;opacity: .7;color: blue;font-size: 1em;"></p>
            <div class="input-group">
               <input id="edit_input_name" type="text" class="form-control" placeholder="plz enter name">
	           <span class="input-group-btn">
               <button id="edit_name" class="btn btn-default" type="button">Go!</button>
               </span>
            </div>
       	   

		</div>
		 <hr>
		 
		<li id="editpass"  data-edit="editpass01" class="editsettings">Edit: Password</li>
		<div id="editpass01" class="editdivsetttings" style="display: none;">

		 <p id="edit_pass_text" style="display: none;opacity: .7;color: blue;font-size: 1em;"></p>
            <div id="edit_pass_get_oldpass" style="display:inline-block;">
            <input id="edit_pass_get_oldpass_input" placeholder="plz enter your currect pass" type="password" class="form-control "></input>
            <button id="edit_pass_get_oldpass_btn" class="btn btn-primary">ok</button>
            </div>
            
            <div id="edit_pass_get_newpass" style="display: none;">
            <input id="edit_pass_get_newpass_input01" placeholder="plz enter your new pass" type="password" class="form-control "></input>
            <input id="edit_pass_get_newpass_input02" placeholder="enter your new pass again " type="password" class="form-control "></input>
            <button id="edit_pass_get_newpass_btn" class="btn btn-primary">ok</button>
            </div>      	   

		</div>
		 <hr>
		 
		<li id="editprofilepic"  data-edit="editprofilepic01" class="editsettings">Edit: profile pic</li> 
		<div id="editprofilepic01" class="editdivsetttings" style="display: none;">
		<div id="editprofilepic-msg"></div>

       	  
				
			 
				
				
			
			<form id="formchangepic">
	<input type="file" name="image" accept="image/png, image/gif, image/jpeg, image/jpg"></input>
	<button class="btn btn-sm btn-primary" type="submit">Upload</button>
<!--	<button type="button" class="btn btn-sm btn-danger cancel">Cansel</button>  -->
	        </form>

	        <div class="progress progress-striped active">
		         <div id="progress-bar" class="progress-bar" style="width: 0%;"></div>
	        </div>
          

		</div>
		<hr>


		<li id="editaddress"  data-edit="editaddress01" class="editsettings">Edit: Address</li>
		<div id="editaddress01" class="editdivsetttings" style="display: none;">

				<input id="editprofile_adrs_st" class="form-control" placeholder="plz enter strret *"></input>
				<input id="editprofile_adrs_ct" class="form-control" placeholder="plz enter city *"></input>
				<input id="editprofile_adrs_cr" class="form-control" placeholder="plz enter country *"></input>
				<br>
				<div id="editprofile_adrs_txt"></div>
				<button id="confirm_address" class="btn btn-primary" style="display: none;">Confirm the address</button>
				<button id="editprofile_find_address" class='btn btn-primary btn-xs' style="float:right">find address</button>

<br class='clear'>

		</div>
		
	</ul>
</div>
   
    
 <script type="text/javascript">  function aa(){location.reload();};
 	$(function () {   


 		$('.editsettings').on('click',function(){
						var tempdivid=$(this).data('edit');
						var dis=$("#"+tempdivid).css("display");
						if (dis=='block') {
							$("#"+tempdivid).slideUp(200);
						}else {
							$('.editdivsetttings').slideUp(200);
							$("#"+tempdivid).slideDown(300);
						}
                  })


 	/*	$('#formchangepic').on('submit',function(e){
 			e.preventDefault();
 			$form=$(this);
 			var formdata=new FormData($form[0]);
			 		
 		})  */
})
 </script>  


 

<?php include 'includes/overall/overallfooter.php'?>
</div>

