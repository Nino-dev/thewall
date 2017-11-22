<head>
<link href="css/lightbox.css" rel="stylesheet">
<script src="js/lightbox.js"></script>
</head>

<?php

// maak connectie
$conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);//maak instance van mysqli class
// check connectie
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//else{echo "Connected <br>";}
//select alles van table pics
//fetch resultaten
$selectquery = "SELECT filename , id , title, description, tag, author, date FROM pics ORDER BY id DESC";
$result = $conn->query($selectquery);
echo '<div id="mygallery">';
if (mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){

  echo '<a href="db/images/'.$row['filename'].'" data-lightbox="wall" data-title="' . 'Uploader: '. $row['author'] . ' | ' .'Titel: ' . $row['title'] . ' | ' . 'Tag: ' . $row['tag'] . ' | ' . 'Beschrijving: ' . $row['description'] . ' | ' . 'Datum: ' . $row['date'] .
  '"><img src="db/images/' . $row['filename'] . '" class=""><div class="caption" style="height: auto; font-size: 20px">' . $row['title'] . ' - ' . $row['author'] .'</div></a>';
    }

echo '</div>';
} else{
    echo "0 resultaten";
}
?>
<body>
  <script>
  $('#mygallery').justifiedGallery({
  rowHeight : 200,
  lastRow : 'nojustify',
  margins : 4
});
  </script>
</body>
