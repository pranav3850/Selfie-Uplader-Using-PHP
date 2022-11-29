<?php

$name = $_POST["name"];
$allowedExts = array("gif", "jpeg", "jpg", "png");
$fileTmpPath = $_FILES['fileToUpload']['tmp_name'];
$temp = explode(".", $_FILES["fileToUpload"]["name"]);
$extension =  strtolower(end($temp));
if ((($_FILES["fileToUpload"]["type"] == "image/gif")
|| ($_FILES["fileToUpload"]["type"] == "image/jpeg")
|| ($_FILES["fileToUpload"]["type"] == "image/jpg")
|| ($_FILES["fileToUpload"]["type"] == "image/pjpeg")
|| ($_FILES["fileToUpload"]["type"] == "image/x-png")
|| ($_FILES["fileToUpload"]["type"] == "image/png"))
&& ($_FILES["fileToUpload"]["size"] < 20000000000000000000000)
&& in_array($extension, $allowedExts))
  {
  if ($_FILES["fileToUpload"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["fileToUpload"]["error"] . "<br>";
    }
  else
    {
    echo "Upload: " . $_FILES["fileToUpload"]["name"] . "<br>";
    echo "Type: " . $_FILES["fileToUpload"]["type"] . "<br>";
    echo "Size: " . ($_FILES["fileToUpload"]["size"] / 1024) . " kB<br>";
    echo "Temp file: " . $_FILES["fileToUpload"]["tmp_name"] . "<br>";

    if (file_exists("upload/" . $_FILES["fileToUpload"]["name"]))
      {
      echo $_FILES["fileToUpload"]["name"] . " already exists. ";
      }
    else
      {
      move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],
      "upload/" .$_FILES["fileToUpload"]["name"]);
      echo "Stored in: " . "upload/" . $_FILES["fileToUpload"]["name"]."<br>";

$image=$_FILES["fileToUpload"]["name"]; /* Displaying Image*/
      $img="upload/".$image;
      echo '<img src= "upload/".$img>'; 

      }
    }
  }
else
  {
  echo "Invalid file";
  }

?>