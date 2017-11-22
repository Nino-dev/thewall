<head>
  <link href="css/lightbox.css" rel="stylesheet">
  <script src="js/lightbox.js"></script>
</head>
<body>
  <div id="zoek">
    <h1>Zoek</h1>
    <form class="" action="?page=zoek   " method="post">


    <input type="search" name="search" placeholder="Zoek op titel/tag/uploader..">
    <input type="submit" name="submit" value="Zoek">
    </form>
  </div>
</body>

<?php
$conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);//maak instance van mysqli class
// check connectie
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['submit'])){

echo '<p id="zoekp" style="font-size: 30px; color: #4A036F;">Je hebt gezocht naar ' . $_POST['search'] . '</p>';
//else{echo "Connected <br>";}
//select alles van table pics
//fetch resultaten
$selectquery = "SELECT filename , id , title, description, tag, author, date FROM pics WHERE (title LIKE '%". $_POST['search'] ."%') or (author LIKE '%". $_POST['search'] ."%') or (tag LIKE '%". $_POST['search'] ."%') ORDER BY id DESC ";
$result = $conn->query($selectquery);
echo '<div id="mygallery">';
if (mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){

  echo '<a href="db/images/'.$row['filename'].'" data-lightbox="wall" data-title="' . 'Uploader: '. $row['author'] . ' | ' .'Titel: ' . $row['title'] . ' | ' . 'Tag: ' . $row['tag'] . ' | ' . 'Beschrijving: ' . $row['description'] . ' | ' . 'Datum: ' . $row['date'] .
  '"><img src="db/images/' . $row['filename'] . '" class=""><div class="caption" style="height: 40px; font-size: 20px">' . $row['title'] . ' - ' . $row['author'] .'</div></a>';
    }

echo '</div>';
} else{
    echo '<p id="noresult">Geen resultaten</p>';
}
}
?>

  <script>
  $('#mygallery').justifiedGallery({
  rowHeight : 200,
  lastRow : 'nojustify',
  margins : 4
});
  </script>
