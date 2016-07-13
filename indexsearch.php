<!DOCTYPE html>
<html>
<head>
	<title>lib</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="lib.js"></script>
</head>
<body>
	<form id="form" class="col-sm-3 col-md-6">
		<input id="uesr_name" name="user_name" type="text" class="form-control" placeholder="user_name*">
		<input id="isbn" name="isbn" type="number" class="form-control" placeholder="isbn*">
	<!--	<input id="title" type="text" class="form-control" placeholder="title*">
		<input id="author" type="text" class="form-control" placeholder="author*">  -->
	</form>
	<br><br><br><br>
	<button id="btnaddbook" class="btn btn-primary">add book</button>
    <div id="txt"></div>
    <br><br><br><br>
    
    <div class="col-lg-6">
    <div class="input-group">
  <input id="searchbook" name="searchbook" type="text" class="form-control" placeholder="enter title or author or isbn" >
  <span class="input-group-btn" >
  	 <button id="btnsearchbook" class="btn btn-secondary" type="button">Go!</button>
  </span>
    </div>
    </div>
    <div class="findbooks" id="findbooks">
      
    </div>
    



   
    
    


</body>
</html>