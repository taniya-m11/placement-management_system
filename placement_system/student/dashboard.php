<?php
include('../config.php'); session_start();
if(!isset($_SESSION['student_id'])) header('Location: ../login.php');
$uid = (int)$_SESSION['student_id'];
$user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM students WHERE id={$uid}"));
?>
<!doctype html><html><head><meta charset='utf-8'><title>Student Dashboard</title><link rel='stylesheet' href='../assets/css/style.css'></head><body>
<div class='container'>
  <h2>Welcome, <?php echo e($user['name']); ?></h2>
  <p class='small'>Roll: <?php echo e($user['roll_no']); ?> | Dept: <?php echo e($user['department']); ?> | CGPA: <?php echo e($user['cgpa']); ?></p>
  <nav>
    <a href='edit_profile.php'><button class="m" >Edit Profile</button></a>
    <a href='view_companies.php'><button class="m">View Companies</button></a>
    <a href='status.php'><button class="m">My Applications</button></a>
    <a href='logout.php'><button class="m">Logout</button></a>
  </nav>
</div></body></html>
