<?php
// Create image instances
// $name =$_GET["name"];


// (B) WRITE TEXT
$txt =$_POST["name"];
$frame = $_POST["sel_img_id"];
$data = $_POST["profile_pic_2"];

list($type, $data) = explode(';', $data);
list(, $data)      = explode(',', $data);
$data = base64_decode($data);

file_put_contents('./small/thump_'.$txt.'.png', $data);
$roundImage = imagecreatefrompng('./small/thump_'.$txt.'.png');
    



function resizeImageSquare($resourceType,$image_width,$image_height) {
    $resizeWidth = 935;
    $resizeHeight = 935;
    $imageLayer = imagecreatetruecolor($resizeWidth,$resizeHeight);
    imagecopyresampled($imageLayer,$resourceType,0,0,0,0,$resizeWidth,$resizeHeight, $image_width,$image_height);
    return $imageLayer;
}

function create_circleSquare( $img_path ) {
    $img1 = imagecreatefromjpeg("/home/u768511311/domains/keryar.com/public_html/Selfie_with_Bapji/upload/".$img_path);
    $imgMeasure = imagecreatefromjpeg("/home/u768511311/domains/keryar.com/public_html/Selfie_with_Bapji/upload/thump_Banke Bihari.jpg");

    $x=imagesx($imgMeasure);
    $y=imagesy($imgMeasure);
    $img2 = imagecreatetruecolor($x, $y);
    $bg = imagecolorallocate($img2, 255,255, 127); // wierdo pink background
    imagefill($img2, 0, 0, $bg);
    imagecolortransparent($img2, $bg);
    $e = imagecolorallocate($img2, 255, 255, 255); // black mask color
    imagefilledellipse ($img2, ($x/2), ($y/2), $x, $y, $e);
    imagecolortransparent($img2, $e);
    imagecopymerge($img1, $img2, 0, 0, 0, 0, $x, $y, 100);
    imagecolortransparent($img1, $bg);
    imagedestroy($img2);
    return $img1;
}

function resizeImageRound($resourceType,$image_width,$image_height) {
    $resizeWidth = 935;
    $resizeHeight = 935;
    $imageLayer = imagecreatetruecolor($resizeWidth,$resizeHeight);
    imagecopyresampled($imageLayer,$resourceType,0,0,0,0,$resizeWidth,$resizeHeight, $image_width,$image_height);
    return $imageLayer;
}

function create_circleRound( $img_path ) {
  
    $img1 = imagecreatefromjpeg("/home/u768511311/domains/keryar.com/public_html/Selfie_with_Bapji/upload/".$img_path);
    $imgMeasure = imagecreatefromjpeg("/home/u768511311/domains/keryar.com/public_html/Selfie_with_Bapji/upload/thump_Banke Bihari.jpg");

    $x=imagesx($imgMeasure);
    $y=imagesy($imgMeasure);
    $img2 = imagecreatetruecolor($x, $y);
    $bg = imagecolorallocate($img2, 255,255, 127); // wierdo pink background
    imagefill($img2, 0, 0, $bg);
    imagecolortransparent($img2, $bg);
    $e = imagecolorallocate($img2, 255, 255, 255); // black mask color
    imagefilledellipse ($img2, ($x/2), ($y/2), $x, $y, $e);
    imagecolortransparent($img2, $e);
    imagecopymerge($img1, $img2, 0, 0, 0, 0, $x, $y, 100);
    imagecolortransparent($img1, $bg);
    imagedestroy($img2);
    return $img1;
}




if($frame ==1 || $frame==4 || $frame == 6)
{
    $dest =imagecreatefromjpeg('bapji'.$frame.'.jpg');
    $fontFile = "/home/u768511311/domains/keryar.com/public_html/Selfie_with_Bapji/Roboto-Black.ttf";
    $fontSize = 100;
    $fontColor = imagecolorallocate($dest, 255, 255, 255);
    $posX = 1700;
    $posY = 2900;
    $angle = 0;
    imagettftext($dest, $fontSize, $angle, $posX, $posY, $fontColor, $fontFile, $txt);
    
    $fileName =$roundImage;
    list($width, $height) = getimagesize('/home/u768511311/domains/keryar.com/public_html/Selfie_with_Bapji/small/thump_'.$txt.'.png');
    $uploadPath = "/home/u768511311/domains/keryar.com/public_html/Selfie_with_Bapji/upload/";
    $fileExt = '.png';
    $uploadImageType='IMAGETYPE_PNG';
    $sourceImageWidth= $width;
    $sourceImageHeight=$height;
    $imageLayer = resizeImageRound($roundImage,$sourceImageWidth,$sourceImageHeight);
    imagejpeg($imageLayer,$uploadPath."thump_".$txt. '.jpg');
   
    
    $src = create_circleRound("thump_".$txt.'.jpg');
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

}
else
{
    $dest =imagecreatefromjpeg('bapji'.$frame.'.jpg');
    $fontFile = "/home/u768511311/domains/keryar.com/public_html/Selfie_with_Bapji/Roboto-Black.ttf";
    $fontSize = 100;
    $fontColor = imagecolorallocate($dest, 255, 255, 255);
    $posX = 1100;
    $posY = 3220;
    $angle = 0;
    imagettftext($dest, $fontSize, $angle, $posX, $posY, $fontColor, $fontFile, $txt);
    
    $fileName =$roundImage;
    list($width, $height) = getimagesize('/home/u768511311/domains/keryar.com/public_html/Selfie_with_Bapji/small/thump_'.$txt.'.png');
    $uploadPath = "/home/u768511311/domains/keryar.com/public_html/Selfie_with_Bapji/upload/";
    $fileExt = '.png';
    $uploadImageType='IMAGETYPE_PNG';
    $sourceImageWidth= $width;
    $sourceImageHeight=$height;
    $imageLayer = resizeImageSquare($roundImage,$sourceImageWidth,$sourceImageHeight);
    imagejpeg($imageLayer,$uploadPath."thump_".$txt. '.jpg');
   
    
    $src = create_circleSquare("thump_".$txt.'.jpg');

    imagecopymerge($dest, $src, 99, 2505 , 0, 0, 935, 935, 100);
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
}


?>