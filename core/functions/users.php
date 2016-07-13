<?php
 
function mail_users($subject,$body){
   $query=mysql_query("SELECT email,fname FROM users WHERE allow_email=1");
   while($row=mysql_fetch_assoc($query)){
       // $body="Hello" .$row['fname']. ",\n\n" .$body;
        email($row['email'],$subject,"Hello" .$row['fname']. ",\n\n" .$body);
    }
}


function is_admin($user_id){
    $user_id=(int)$user_id;//echo $user_id;
    return (mysql_result(mysql_query("SELECT COUNT(id) FROM users WHERE id='$user_id' AND type=1"),0)==1) ? true : false;
//echo mysql_result($query,0);

}

function recover($mode,$email){
$mode  =sanitize($mode);
$email =sanitize($email);
   $user_data=user_data(user_id_from_email($email),'id','fname','username');
//return $user_data['username'];
   if($mode=='username')
       {
        email($email,'Your username',"Helllo " .$user_data['fname']. ",\n\nYour username is: " .$user_data['username']. "  ");
    
       }else if($mode='password')
                   {
                    $generated_password=substr(md5(rand(999,999999)),0,8);
                    update_password($user_data['id'],$generated_password);
                    email($email,'Your password',"Helllo " .$user_data['fname']. ",\n\nYour password is: " .$generated_password. "  ");
                   }
}


function update_user($update_data){
global $session_user_id;
$update=array();
foreach($update_data as $field=>$data)
   {
     $update[]=''.$field.'=\''.$data.'\'';//print_r ($update);
   }
     echo implode(',',$update); 
    mysql_query("UPDATE users SET ".implode(',',$update)." WHERE id=$session_user_id") or die(mysql_error());
}


function activate($email,$email_code){
$email     =mysql_real_escape_string($email);
$email=strip_tags($email);
$email_code=mysql_real_escape_string($email_code);

if(mysql_result(mysql_query("SELECT COUNT('id') FROM users WHERE email='$email' AND email_code='$email_code' AND active=0"),0)==1){
mysql_query("UPDATE users SET active=1 WHERE email='$email'");
return true;
}else {  return false;}
}



function user_id_from_username($username){
$query=mysql_query("SELECT id FROM users WHERE username='$username'");
return mysql_result($query, 0);
}



function user_id_from_email($email){
$query=mysql_query("SELECT id FROM users WHERE email='$email'");
return mysql_result($query, 0);
}



function email($to,$subject,$body){
mail($to,$subject,$body,"From: pedram@example.com");
}

//$username,$password,$email,$email_code,$firstname,$address,$lat,$lon;

function register_user($register_data){
	$register_data[1]=md5($register_data[1]);
    $data='\''.implode('\',\'', $register_data).'\'';
     //print_r($data);
	$query="INSERT INTO users (username,password,email,email_code,fname,address,lat,lon) VALUES ($data)";
	mysql_query($query);
       $to=$register_data[2];
       $subject="Active your account";
       $body=
"Hello " .$register_data[4]. "\n\n You need to active your account,so please use the link below:\n\n  http://pedram-feyz.com/lib/activate.php?email=" .$register_data[2]. "&email_code=" .$register_data[3]. "&e=" .$register_data[4]. " \n\n"
;

    email($to,$subject,$body);
}



function user_count(){
	$query=mysql_query('SELECT count(id) FROM users WHERE active=1');
	return mysql_result($query, 0);
}



function user_data($user_data){
     $data=array();
     $user_id=(int)$user_data;
    // echo $user_id .'<br>';
    $func_num_args=func_num_args();
     $func_get_args=func_get_args();
      if($func_num_args>1){
     	unset($func_get_args[0]);
     $fields=implode(',', $func_get_args);
     // echo $fields;
      $data=mysql_fetch_assoc(mysql_query("SELECT $fields FROM users WHERE      id=$user_id"));
      
      return $data;
// print_r($data);
      //die();
 /* while ($row=mysql_fetch_assoc($query)) 
        {
          $dbusername=$row['fname'];
          $dbpassword=$row['password'];
        }
        echo $dbusername;echo  $dbpassword;*/
     }
}

function user($id){
  $data=mysql_fetch_assoc(mysql_query("SELECT username,email,address,lat,lon,fname,profile_pic FROM users WHERE  id=$id"));
      return $data;
}

function book($isbn){
  $data=mysql_fetch_assoc(mysql_query("SELECT * FROM libbook WHERE  isbn='$isbn'"));
      return $data;
}


function logged_in(){
	return (isset($_SESSION['user_id'])) ? true : false;
}



function user_exists($username)
{
   $query=mysql_query("SELECT * FROM users WHERE username='$username'");
   $numrows=mysql_num_rows($query);
   //if ($numrows!=0)mysql_result($query, 0)==1
   return ($numrows!=0) ? true :false;
};



function email_exists($email)
{  $email=mysql_real_escape_string($email);
   $email=strip_tags($email);
   $query=mysql_query("SELECT * FROM users WHERE email='$email'");
   $numrows=mysql_num_rows($query);//echo $numrows;
   //if ($numrows!=0)mysql_result($query, 0)==1
   return ($numrows!=0) ? true :false;
};



function user_active($emaiorusername){
$query=mysql_query("SELECT active FROM users WHERE (username='$emaiorusername') OR (email='$emaiorusername') ");
$record=mysql_fetch_assoc($query);
//echo '<br>'.$record['active'];
return ($record['active']==1) ? true :false;
}



function login($emaiorusername,$password) {
$password=md5($password);
//echo $password;
$query=mysql_query("SELECT * FROM users WHERE (username='$emaiorusername' AND password='$password') OR (email='$emaiorusername' AND password='$password') ");
$numrows=mysql_num_rows($query);
$record=mysql_fetch_assoc($query);//echo $record['id'];
return ($numrows!=0) ? $record['id'] :false;
//echo $numrows;
}



function protect_page(){
	if(logged_in()===false){ header('Location:signin.php'); exit();}
}


function admin_protect(){
global $user_data;
    if(is_admin($user_data['id'])===false){
                              header('Location:index.php'); exit();
                             }

}


function logged_in_redirect(){
	if(logged_in()===true){ header('Location:index.php'); exit();}
}


function output_errors($errors)
{return '<ul><li>'.implode('</li><li>', $errors).'</ul></li>';}



function password_match($id,$password){
	$password=md5($password);
//echo $password;
$query=mysql_query("SELECT * FROM users WHERE (id='$id' AND password='$password')");
$numrows=mysql_num_rows($query);
return ($numrows!=0) ? true :false;}
function update_password($id,$new_password){
$new_password=md5($new_password);	
$query=mysql_query("UPDATE users SET password='$new_password'  WHERE id ='$id'"); 
}




function array_sanitize($item){
  $item=htmlentities(strip_tags(mysql_real_escape_string($item)));
}

function sanitize($data){
  return htmlentities(strip_tags(mysql_real_escape_string($data)));
}

function change_address_to_coord ($address){

    //$address = '800 kent st, sydney, australia'; // Your address
            $prepAddr = str_replace(' ','+',$address);

            $geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');

            $output= json_decode($geocode);

             $lat = $output->results[0]->geometry->location->lat;
             $long = $output->results[0]->geometry->location->lng;
             $adr =$output->results[0]->formatted_address;
             $arrayguest_pos=array("adr"=>$address, "lat"=>$lat, "lon"=>$long,"adrcom"=>$adr);

            // return $address.'<br>Lat: '.$lat.'<br>Long: '.$long.'<br>adr:'.$adr.'';
             return $arrayguest_pos;
         }

 //********************************
 
 
  function distance($lat1, $lon1, $lat2, $lon2, $unit) {

  $theta = $lon1 - $lon2;
  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
  $dist = acos($dist);
  $dist = rad2deg($dist);
  $miles = $dist * 60 * 1.1515;
  $unit = strtoupper($unit);

  if ($unit == "K") {
    return ($miles * 1.609344);
  } else if ($unit == "N") {
      return ($miles * 0.8684);
    } else {
        return $miles;
      }


//echo distance(-33.8645485, 151.2041362,  -33.8759449,151.2054534, "M") . " Miles<br>";
//echo distance(32.9697, -96.80322, 29.46786, -98.53506, "K") . " Kilometers<br>";
//echo distance(32.9697, -96.80322, 29.46786, -98.53506, "N") . " Nautical Miles<br>";
}            
//************************************
// Simple function to sort an array by a specific key. Maintains index association.

function array_sort($array, $on, $order=SORT_ASC)
{
    $new_array = array();
    $sortable_array = array();

    if (count($array) > 0) {
        foreach ($array as $k => $v) {
            if (is_array($v)) {
                foreach ($v as $k2 => $v2) {
                    if ($k2 == $on) {
                        $sortable_array[$k] = $v2;
                    }
                }
            } else {
                $sortable_array[$k] = $v;
            }
        }

        switch ($order) {
            case SORT_ASC:
                asort($sortable_array);
            break;
            case SORT_DESC:
                arsort($sortable_array);
            break;
        }

        foreach ($sortable_array as $k => $v) {
            $new_array[$k] = $array[$k];
        }
    }

    return $new_array;
}

function sortById($x, $y) {
    return $y['percent'] - $x['percent'];
}

//selset all the books from libbbok table
function selectallbooks(){
  $query="SELECT * FROM libbook";
  $result=mysql_query($query);
  if (mysql_num_rows($result) >0) {
     while ($row=mysql_fetch_assoc($result)) {
                $arrayallbooks[]=$row;    
     }
  }  return $arrayallbooks;
}


 function findbooksnearme($id,$lat,$lon){
  $json = file_get_contents('user-isbn.json');
         $arrayuserisbnjson= json_decode($json,true);
       //  print_r($arrayuserisbnjson);echo "<br><br>";
         // get id of users in user-isbn.json
         foreach ($arrayuserisbnjson as $key => $value) {
                $userid[]= $key;
          }
         // print_r($userid);echo "<br>".$id."<br>";
         // echo array_search($id, $userid);
          // find and remove the id of user who logged in caz we don't wanna show that user his/her books
          if (  array_search($id, $userid)!==false ) {
             $pos = array_search($id, $userid);
                      unset($userid[$pos]);
          }
       
       // get id,username,lat,lon of users that exist in user-isbn.json from uesrs table for compare to address of current user
        $struserid="(id='".implode("')or(id='",$userid)."')";//echo $struserid;
        $result=mysql_query("SELECT id,username,lat,lon FROM users WHERE  $struserid");
        while ($row=mysql_fetch_assoc($result)) {
             $arrayuserlatlon[]=$row;
        }
        
        foreach ($arrayuserlatlon as $temp) {
          $id01=$temp['id'];
          $lat01 =$temp['lat'];
          $lon01 =$temp['lon'];/// echo $id01.'<br>'.$lat01.'<br>'.$lon01.'<br>';
          $distance=distance($lat, $lon, $lat01, $lon01, 'k');
          $arraydistance[$id01]=$distance;
          
        } 
          asort($arraydistance);
          ///print_r($arraydistance);// $arraydistance(id of the users who are nearest person to current user,distance)
    ///echo ' **************************************.<br>';
          
          foreach ($arraydistance as $key => $value) {
               // echo $key.'<br>';
               // print_r( $arrayuserisbnjson[$key]);echo '<br>';
                      if(!empty($arrayuserisbnjson[$key])){
                foreach ($arrayuserisbnjson[$key] as $temp) {
                  // ignore the books with same isbn
                   
                   if (  !(in_array($temp,$arrayignoreRepeatedlyisbn)) )
                    {
                      $arrayfinalfindbook[]=array($key,$temp);
                      $arrayignoreRepeatedlyisbn[]=$temp;
                    }
                    
                }
                }

          }//print_r($arrayfinalfindbook);echo '<br><br>';//arrayfinalfindbook(id of the users who are nearest person to current user ,isbn)
         // echo '$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$';
           
     return $arrayfinalfindbook;}


          function findnearestuserswhohasspecifiedbooktocurrentuser ($isbn,$lat,$lon,$id){
            $json = file_get_contents('isbn-user.json');
                $arrayData= json_decode($json,true);
                // print_r($arrayData[$isbn]);echo '<br>';
                 
                 // remove the id of current user caz we don't wanna show him ,his book too
                  if (  array_search($id, $arrayData[$isbn])!==false ) {
             $pos = array_search($id, $arrayData[$isbn]);
                      unset($arrayData[$isbn][$pos]);
          }

               $struserid="(id='".implode("')or(id='",$arrayData[$isbn])."')";//echo $struserid;
               $result=mysql_query("SELECT id,username,lat,lon FROM users WHERE  $struserid  ");
            while ($row=mysql_fetch_assoc($result)) {
                 $arrayuserlatlon[]=$row;
            }
            
            foreach ($arrayuserlatlon as $temp) {
              $id01=$temp['id'];
              $lat01 =$temp['lat'];
              $lon01 =$temp['lon'];/// echo $id01.'<br>'.$lat01.'<br>'.$lon01.'<br>';
              $distance=distance($lat, $lon, $lat01, $lon01, 'k');
              $arraydistance[$id01]=$distance;
              
            } 
          asort($arraydistance);
          return     $arraydistance;
          }
//new messageses
          function checkNewMsg($id){
            $query=mysql_query("SELECT new_message FROM users WHERE id='$id' ");
            $result=mysql_result($query, 0);
            return $result;
          }
        // edit profile like name and address
         function change_name($name,$id){
          mysql_query("UPDATE users SET fname='$name' WHERE id='$id'");
          return 'the name has changed successfully';
         }
         
         function change_address($lat,$lon,$address,$id){
          mysql_query("UPDATE users SET address='$address',lat='$lat',lon='$lon' WHERE id='$id'");
          return 'the address has changed successfully';
         }
         /// 
         function save($data,$addressfile){
    $json =json_encode($data);
    $file =fopen($addressfile, "w");
    fwrite($file, $json);
}

?>