<?php
include('config.php');
session_start();
$msg='';
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['login'])){
  $email=mysqli_real_escape_string($conn,$_POST['email']);
  $pass=md5($_POST['password']);
  $res = mysqli_query($conn, "SELECT * FROM students WHERE email='{$email}' AND password='{$pass}'");
  if(mysqli_num_rows($res)==1){
    $user = mysqli_fetch_assoc($res);
    $_SESSION['student_id']=$user['id'];
    header('Location: student/dashboard.php'); exit;
  } else $msg='Invalid credentials';
}
?>
<!doctype html><html><head><meta charset='utf-8'><title>Student Login</title><link rel='stylesheet' href='assets/css/style.css'></head><body>
  
<div class='container'><h2>Student Login</h2>
<form class='form' method='post'>
  <label>Email</label>
  <input class='input' name='email' placeholder='abc@gmail.com' type='email' required>
  <label>Password</label>
  <input class='input' name='password' placeholder='Password' type='password' required>
  <button class='btn' name='login' type='submit'>Login</button>
</form>
<p class='small'><?php echo $msg; ?></p>
<p><a href='register.php'>Register</a> | <a href='index.php'>Home</a></p></div></body></html>
