<?php
include('../config.php');
session_start();
$msg='';
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['login'])){
  $username=mysqli_real_escape_string($conn,$_POST['username']);
  $pass=md5($_POST['password']);
  $res = mysqli_query($conn, "SELECT * FROM admin WHERE username='{$username}' AND password='{$pass}'");
  if(mysqli_num_rows($res)==1){
    $_SESSION['admin_logged']=true;
    header('Location: dashboard.php'); exit;
  } else $msg='Invalid admin credentials';
}
?>
<!doctype html><html><head><meta charset='utf-8'><title>Admin Login</title><link rel='stylesheet' href='../assets/css/style.css'></head><body>
<div class='container'><h2>Admin Login</h2>
<form class='form' method='post'>
  <label>Username</label>
  <input class='input' name='username' required>
  <label>Password</label>
  <input class='input' name='password' type='password' required>
  <button class='btn' name='login' type='submit'>Login</button>
</form>
<p class='small'><?php echo $msg; ?></p>
<p><a href='../index.php'>Home</a></p></div></body></html>
