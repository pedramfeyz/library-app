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
 
if (isset($_FILES['image'])) {
	if (empty($_FILES['image']['name'])) {
		echo "please choose a file";
	} else { 
		$allowed=array('jpg','jpeg','gif','png');
         //echo $_FILES['image']['size'];
		$file_name=$_FILES['image']['name'];
		$file_extn=strtolower(end(explode('.', $file_name)));
		$file_temp=$_FILES['image']['tmp_name'];




             //rotate
        $image= imagecreatefromstring(file_get_contents($file_temp));
        $exif = exif_read_data($_FILES['image']['tmp_name']);
            if(!empty($exif['Orientation'])) {
                   switch($exif['Orientation']) {
                        case 8:
                            $image = imagerotate($image,90,0);
                            break;
                        case 3:
                            $image = imagerotate($image,180,0);
                            break;
                        case 6:
                            $image = imagerotate($image,-90,0);
                            break;
                      }//end of switch

                  imagepng( $image, $file_temp ); // adjust format as needed
                  imagedestroy( $image);
                }//end of if





             // resize the image 
        $maxDim = 200;
        list($width, $height, $type, $attr) = getimagesize( $_FILES['image']['tmp_name'] );
        if ( $width > $maxDim || $height > $maxDim ) {

            $file_temp = $_FILES['image']['tmp_name'];

            $fn = $_FILES['image']['tmp_name'];
            $size = getimagesize( $fn );
            $ratio = $size[0]/$size[1]; // width/height
                if( $ratio > 1) {
                    $width = $maxDim;
                    $height = $maxDim/$ratio;
                } else {
                    $width = $maxDim*$ratio;
                    $height = $maxDim;
                }
            $src = imagecreatefromstring( file_get_contents( $fn ) );
            $dst = imagecreatetruecolor( $width, $height );
            imagecopyresampled( $dst, $src, 0, 0, 0, 0, $width, $height, $size[0], $size[1] );
            imagedestroy( $src );
            imagepng( $dst, $file_temp ); // adjust format as needed
            imagedestroy( $dst );

        }

                    
		if (in_array($file_extn, $allowed)) {
			change_fiels_image($id, $file_temp);

		}else{
			echo "Incorrecy file type. Allowed: ";
			echo implode(', ', $allowed);
		}

	} 
}  // end if (isset($_FILES['image']))





function  change_fiels_image($id, $file_temp){

	$file_path='profile/images/'.$id.'.png'; 
     
	$bool= move_uploaded_file($file_temp, $file_path);// upload file from client to server /this function returns true on success
	if ($bool==true) {
        mysql_query("UPDATE users SET profile_pic='$file_path'   WHERE id=$id");
		echo 'The image has uploaded';
	}
}// end function

  
?>
 





