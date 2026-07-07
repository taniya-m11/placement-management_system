<?php
include('../config.php'); session_start();
if(!isset($_SESSION['student_id'])) header('Location: ../login.php');
$uid=(int)$_SESSION['student_id'];
$msg='';
if($_SERVER['REQUEST_METHOD']=='POST'){
  $name=mysqli_real_escape_string($conn,$_POST['name']);
  $roll=mysqli_real_escape_string($conn,$_POST['roll_no']);
  $dept=mysqli_real_escape_string($conn,$_POST['department']);
  $cgpa=floatval($_POST['cgpa']);
  // resume replace
  if(isset($_FILES['resume']) && $_FILES['resume']['error']==0){
    $target_dir = "../uploads/resumes/";
    if(!is_dir($target_dir)) mkdir($target_dir,0755,true);
    $resume_path = $target_dir . time() . '_' . basename($_FILES['resume']['name']);
    move_uploaded_file($_FILES['resume']['tmp_name'],$resume_path);
    mysqli_query($conn, "UPDATE students SET resume='{$resume_path}' WHERE id={$uid}");
  }
  mysqli_query($conn, "UPDATE students SET name='{$name}', roll_no='{$roll}', department='{$dept}', cgpa={$cgpa} WHERE id={$uid}");
  $msg='Profile updated';
}
$user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM students WHERE id={$uid}"));
?>
<!doctype html><html><head><meta charset='utf-8'><title>Edit Profile</title><link rel='stylesheet' href='../assets/css/style.css'></head><body>
<div class='container'>
  <h2>Edit Profile</h2>
  <form class='form' method='post' enctype='multipart/form-data'>
    <label>Full name</label>
    <input class='input' name='name' value='<?php echo e($user['name']); ?>' required>
    <label>Roll No</label>
    <input class='input' name='roll_no' value='<?php echo e($user['roll_no']); ?>' required>
    <label>Department</label>
    <input class='input' name='department' value='<?php echo e($user['department']); ?>' required>
    <label>CGPA</label>
    <input class='input' name='cgpa' value='<?php echo e($user['cgpa']); ?>' required>
    <label>Replace resume (optional)</label>
    <input class='input' name='resume' type='file'>
    <button class='btn' type='submit'>Save</button>
  </form>
  <p class='small'><?php echo $msg; ?></p>
  <p><a href='dashboard.php'>Back</a></p>
</div></body></html>
