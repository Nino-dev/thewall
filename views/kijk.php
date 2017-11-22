<head>
<link href="css/lightbox.css" rel="stylesheet">
<script src="js/lightbox.js"></script>
</head>
<?php
session_start();

// maak connectie
$conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);//maak instance van mysqli class
// check connectie
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//else{echo "Connected <br>";}

if(!isset($_SESSION['username']))
{
 header("Location: ?page=login");
}
$select = "SELECT * FROM users WHERE username= '$_SESSION[username]'";
$result=$conn->query($select);
$userRow=mysqli_fetch_assoc($result);

if ($result === FALSE) {
    die ("Mysql Error: " . $conn->error);
}


echo '<h1 style="font-size: 30px;" id="loginh1">Welkom '.$userRow['username'].'</h1>';


echo '<h2 id="loginh2">Mijn Uploads</h2>';
echo '<a href="views/logout.php" style="color: #4A036F; font-size: 20px"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span></a>';
$selectquery = "SELECT filename , id , title, description, tag, author, date FROM pics WHERE author = '$_SESSION[username]'  ORDER BY id DESC";
$result2 = $conn->query($selectquery);
echo '<div id="mygallery">';
if (mysqli_num_rows($result2) > 0){
    while($row = mysqli_fetch_assoc($result2)){

  echo '<a href="db/images/'.$row['filename'].'" data-lightbox="wall" data-title="' . 'Uploader: '. $row['author'] . ' | ' .'Titel: ' . $row['title'] . ' | ' . 'Tag: ' . $row['tag'] . ' | ' . 'Beschrijving: ' . $row['description'] . ' | ' . 'Datum: ' . $row['date'] .
  '"><img src="db/images/' . $row['filename'] . '" class=""><div class="caption" style="height: auto; font-size: 20px">' . $row['title'] . ' - ' . $row['author'] .'</div></a>';
    }

echo '</div>';
} else{
    
}

echo "<script>
$('#mygallery').justifiedGallery({
rowHeight : 200,
lastRow : 'nojustify',
margins : 4
});";
echo "</script>";
?>
