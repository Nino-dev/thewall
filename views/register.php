<h1 id="registh1">Registreer</h1>
<div id="login-form">
<form method="post">
<table>
<tr>
<td><input type="text" name="uname" placeholder="Gebruikersnaam" required="required" /></td>
</tr>
<tr>
<td><input type="email" name="email" placeholder="Email" required="required" /></td>
</tr>
<tr>
<td><input type="password" name="pass" placeholder="Wachtwoord" required="required" /></td>
</tr>
<tr>
<td><input type="submit" name="btn-signup" value="Registreer"></td>
</tr>
<tr>
<td><a href="?page=login" style="color: #4A036F; font-size: 20px">Log hier in</a></td>
</tr>
</table>
</form>
</div>

<?php

// maak connectie
$conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);//maak instance van mysqli class
// check connectie
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//else{echo "Connected <br>";}

if(isset($_POST['btn-signup']))
{
 $uname = addslashes($_POST['uname']);
 $email = addslashes($_POST['email']);
 $upass = md5(addslashes($_POST['pass']));



 $insertquery = "INSERT INTO users(username, email, password)
 VALUES ('$uname', '$email', '$upass')";

 if ($conn->query($insertquery) === TRUE) {
     echo '<p id="registp">Je bent geregistreerd!</p>';
 } else {
     echo '<p id="registp2">Dit emailadres is al geregistreerd!</p>';
 }
 }
?>
