<?php
error_reporting(0);
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
         };

if ( empty($_GET['st'])==false && empty($_GET['ct'])==false && empty($_GET['cr'])==false ) {
 	$address=$_GET['st'].','.$_GET['ct'].','.$_GET['cr'];
 	$arrayguest_pos=change_address_to_coord ($address);
 	if ( $arrayguest_pos['adrcom'] !='' && $arrayguest_pos['lat'] !='' && $arrayguest_pos['lon'] !='' ) {
 		?> <input id="lat"  name='lat'   value='<?php echo $arrayguest_pos['lat'] ?>' style='display: none;'></input> <?php
 		?> <input id="lon"  name='lon'   value='<?php echo $arrayguest_pos['lon'] ?>' style='display: none;'></input> <?php
 		?> <input id="address"  name='address'   value='<?php echo $arrayguest_pos['adrcom'] ?>' style='display: none;'></input> <?php
 	  ?> <p id="address" name='addrss' data-address='<?php echo $arrayguest_pos['adrcom'] ?>'> <?php echo $arrayguest_pos['adrcom'] ?>  </p> <?php
 	 
 	   
 	} else {echo 'Sorry,The google map isn\'t able to recogdnise the address,plz entre the address properly again';};
 	 
 	echo '<br><br>';}
 	

?>
