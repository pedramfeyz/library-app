<<!DOCTYPE html>
<html>
<head>
	<title>LIBRARY</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <!-- font awesome -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
  
</head>
<body>
<div class="container"></div>

<form id="formchangepic">
	<input type="file" name="image"></input>
	<button class="btn btn-sm btn-upload" type="submit">Upload</button>
	<button type="button" class="btn btn-sm btn-danger cancel">Cansel</button>

	<div class="progress progress-striped active">
		<div id="progress-bar" class="progress-bar" style="width: 0%;"></div>
	</div>
</form>

<script type="text/javascript">
	
	$('#formchangepic').on('submit',function(e) {
		e.preventDefault();
		$form=$(this);
		var formdata=new FormData($form[0]);
 
		var request=new XMLHttpRequest();
		request.open('post','testserver.php');
		request.send(formdata);
	})

</script>

</body>
</html>

   $('#formchangepic').on('submit',function(e) {
    e.preventDefault();
    $form=$(this);
    var formdata=new FormData($form[0]);
    var request=new XMLHttpRequest();
    
    
    
    request.open('post','changeprofilepic.php');
    request.send(formdata);
     request.onreadystatechange = function() {
     if ( request.status == 200  && request.readyState == 4) {
          $('#editprofilepic-msg').text(request.responseText);
       } 
     }
  })
