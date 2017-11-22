<?php
session_start();
if(isset($_SESSION['username']))
{

}
else{
  header("Location: ?page=uploadno");

}
 ?>

<h1 id="loginh1">Uploaden</h1>
<h3 id="loginh1">Geen GIFS of afbeeldingen groter dan 2MB!</h3>
<form action="db/upload.php" method="post" enctype="multipart/form-data" id="login-form">
  <label for="title">Titel:</label>
    <input type="text" name="title" placeholder="Titel afbeelding" required="required">
    <br>
    <label for="description">Beschrijving:</label>
    <input type="text" name="description" placeholder="Beschrijving afbeelding" required="required">
    <br>
    <label for="tag">Tag:</label>
    <input type="text" name="tag" placeholder="Tag afbeelding" required="required">
    <br>
    <br>
    <input type="file" name="fileToUpload" style="color: #4A036F">
    <br>
    <br>
    <input type="image" src="images/upload.png" border="0" alt="submit" id="uploadbutton" />
</form>
