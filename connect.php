<?php

mysql_connect('localhost','username','pass') or die('we can\'t connect to servser:'.mysql_error());
mysql_select_db('libbookstore') or die('we can\'t connect to database:'.mysql_error());
?>
