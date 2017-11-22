<?php
// maak connectie
session_start();

include 'dbconnect.php';
$conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);//maak instance van mysqli class
// check connectie
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//else{echo "Connected <br>";}

//upload file naar de server
//var_dump($_FILES);
$image_path = 'images/';
$target_file = $image_path . basename($_FILES["fileToUpload"]["name"]);
$filename = $_FILES['fileToUpload']['name'];
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

$image_size = getimagesize($_FILES['fileToUpload']['tmp_name']);

$title = addslashes($_POST['title']);
$description = addslashes($_POST['description']);
$tag = addslashes($_POST['tag']);
$author = $_SESSION['username'];

//check of het een image is
if($image_size==FALSE){
    die(header("Location: ../?page=noimg"));
}
if ($_FILES["fileToUpload"]["size"] > 2048000) {
    die(header("Location: ../?page=teveelmbnogif"));
}
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
) {
    die(header("Location: ../?page=teveelmbnogif"));
}
if ($filename == "image.png"){
    $filename = 'image' . rand(0,999999) . '.png';
}

if ($filename == "image.jpeg"){
    $filename = 'image' . rand(0,999999) . '.jpeg';
}

if ($filename == "image.jpg"){
    $filename = 'image' . rand(0,999999) . '.jpg';
}
$tmp_filename = $_FILES['fileToUpload']['tmp_name'];
$destination = $image_path . $filename;

//maak en voer insert query uit
$insertquery = "INSERT INTO pics (filename, tmp_filename, title, description, tag, author)
VALUES ('$filename', '$tmp_filename', '$title', '$description', '$tag', '$author')";

if (!$conn->query($insertquery) === TRUE) {
  //  echo "INSERT gelukt" . "<br>";
} else {

    echo "Error: " . $insertquery . "<br>" . $conn->error;
}

if (move_uploaded_file($tmp_filename, $destination)) {
    header("Location: ../?page=home");
} else {
    echo 'Fout tijdens uploaden' . '<br>';
}



$conn->close();
?>
