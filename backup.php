<?php
// Create image instances
// $name =$_GET["name"];


// (B) WRITE TEXT
$txt =$_POST["name"];
$frame = $_POST["sel_img_id"];
echo $frame;



$dest =imagecreatefromjpeg('bapji'.$frame.'.jpg');
$fontFile = "/home/u768511311/domains/keryar.com/public_html/Selfie_with_Bapji/Roboto-Black.ttf"; // CHANGE TO YOUR OWN!
$fontSize = 100;
$fontColor = imagecolorallocate($dest, 255, 255, 255);
$posX = 1700;
$posY = 2900;
$angle = 0;

imagettftext($dest, $fontSize, $angle, $posX, $posY, $fontColor, $fontFile, $txt);
  $fileName = $_FILES['fileToUpload']['tmp_name']; 
  $sourceProperties = getimagesize($fileName);
  $resizeFileName = time();
  $uploadPath = "/home/u768511311/domains/keryar.com/public_html/Selfie_with_Bapji/upload/";
  $fileExt = pathinfo($_FILES['fileToUpload']['name'], PATHINFO_EXTENSION);
  $uploadImageType = $sourceProperties[2];
  $sourceImageWidth = $sourceProperties[0];
  $sourceImageHeight = $sourceProperties[1];
  switch ($uploadImageType) {
      case IMAGETYPE_JPEG:
          $resourceType = imagecreatefromjpeg($fileName); 
          $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
          imagejpeg($imageLayer,$uploadPath."thump_".$txt.'.'. $fileExt);
          break;

      case IMAGETYPE_GIF:
          $resourceType = imagecreatefromgif($fileName); 
          $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
          imagegif($imageLayer,$uploadPath."thump_".$txt.'.'. $fileExt);
          break;

      case IMAGETYPE_PNG:
          $resourceType = imagecreatefrompng($fileName); 
          $imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
          imagepng($imageLayer,$uploadPath."thump_".$txt.'.'. $fileExt);
          break;

      default:
          $imageProcess = 0;
          break;
  }
  move_uploaded_file($fileName, $uploadPath. $txt. ".". $fileExt);

  function resizeImage($resourceType,$image_width,$image_height) {
    $resizeWidth = 935;
    $resizeHeight = 935;
    $imageLayer = imagecreatetruecolor($resizeWidth,$resizeHeight);
    imagecopyresampled($imageLayer,$resourceType,0,0,0,0,$resizeWidth,$resizeHeight, $image_width,$image_height);
    return $imageLayer;
}

function create_circle( $img_path ) {
    // Attribution: by NerdsOfTech
    $img1 = imagecreatefromjpeg("/home/u768511311/domains/keryar.com/public_html/Selfie_with_Bapji/upload/".$img_path);
    $imgMeasure = imagecreatefromjpeg("/home/u768511311/domains/keryar.com/public_html/Selfie_with_Bapji/upload/thump_Banke Bihari.jpg");


    $x=imagesx($imgMeasure);
    $y=imagesy($imgMeasure);
 


    // Step 2 - Create a blank image.
    $img2 = imagecreatetruecolor($x, $y);

    $bg = imagecolorallocate($img2, 255,255, 127); // wierdo pink background
    //  $bg = imagecolorallocate($img2, 0, 0, 0, 127 ); // white background

    imagefill($img2, 0, 0, $bg);
    imagecolortransparent($img2, $bg);

    // Step 3 - Create the ellipse OR circle mask.
    $e = imagecolorallocate($img2, 255, 255, 255); // black mask color

    // Draw a ellipse mask
    imagefilledellipse ($img2, ($x/2), ($y/2), $x, $y, $e);

    // OR
    // Draw a circle mask
    // $r = $x <= $y ? $x : $y; // use smallest side as radius & center shape
    // imagefilledellipse ($img2, ($x/2), ($y/2), $r, $r, $e);

    // Step 4 - Make shape color transparent
    imagecolortransparent($img2, $e);

    // Step 5 - Merge the mask into canvas with 100 percent opacity
    imagecopymerge($img1, $img2, 0, 0, 0, 0, $x, $y, 100);

    // Step 6 - Make outside border color around circle transparent
    imagecolortransparent($img1, $bg);

    /* Clean up memory */
    imagedestroy($img2);

    return $img1;
}

$src = create_circle("thump_".$txt.'.'.$fileExt);
imagecopymerge($dest, $src, 685, 2318, 0, 0, 935, 935, 100);
imagejpeg( $dest,'/home/u768511311/domains/keryar.com/public_html/Selfie_with_Bapji/output/'.$txt.".".$fileExt);
$attachment_location = '/home/u768511311/domains/keryar.com/public_html/Selfie_with_Bapji/output/'.$txt.".".$fileExt;

header('Content-Type: image/jpeg');
header("Pragma: public"); // required
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");  
header('Content-Description: File Transfer');

header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");
header("Cache-Control: private",false); // required for certain browsers
header('Content-Type: application/octet-stream');
header("Content-Disposition: attachment; filename=\"".basename($attachment_location)."\";" );
header("Content-Transfer-Encoding: binary");
readfile($attachment_location);
flush();



?>