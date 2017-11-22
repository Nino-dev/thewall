<?php
session_start();

// maak connectie
$conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);//maak instance van mysqli class
// check connectie
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_SESSION['username'])!="")
{
 header("Location: ?page=kijk");
}
?>



<body>
<h1 id="loginh1">Login</h1>
<div id="login-form">
<form method="post">
<table>
<tr>
<td><input type="text" name="email" placeholder="Email" required="required" /></td>
</tr>
<tr>
<td><input type="password" name="pass" placeholder="Wachtwoord" required="required" /></td>
</tr>
<tr>
<td><input type="submit" name="btn-login" value="Login"></td>
</tr>
<tr>
<td><a href="?page=register" style="color: #4A036F; font-size: 20px">Registreer hier</a></td>
</tr>
</table>
</form>
</div>

</body>
</html>
<?php
if(isset($_POST['btn-login']))
{
 $email = addslashes($_POST['email']);
 $upass = addslashes($_POST['pass']);
 $selectquery = "SELECT * FROM users WHERE email='$email'";
 $result = $conn->query($selectquery);
 $row=mysqli_fetch_assoc($result);
 if($row['password']==md5($upass))
 {
  $_SESSION['username'] = $row['username'];
  header("Location: ?page=kijk");
 }
 else
 {
  echo '<p id="loginp">Dit account bestaat niet!</p>';
 }

} ?>
