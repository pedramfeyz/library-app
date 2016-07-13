<<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<form action="" method="post" enctype="multipart/form-data">
	<input type="file" name="profile"></input>
	<input type="submit"></input>
</form>
<?php
//$filenameIn  = $_POST['text'];
$a=http://books.google.com.au/books/content?id=s5gTRQAACAAJ&printsec=frontcover&img=1&zoom=5&source=gbs_api
$url='http://books.google.com.au/books/content?id=s5gTRQAACAAJ&printsec=frontcover&img=1&zoom=5&source=gbs_api';

$filenameOut ='profile/images/'.substr(md5(time()), 0,10).'.jpg';


$contentOrFalseOnFailure   = file_get_contents($url);

$byteCountOrFalseOnFailure = file_put_contents($filenameOut, $contentOrFalseOnFailure);

?>





</body>
</html>