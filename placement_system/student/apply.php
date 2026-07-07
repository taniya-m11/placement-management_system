<?php
include('../config.php'); session_start();
if(!isset($_SESSION['student_id'])) header('Location: ../login.php');
$uid=(int)$_SESSION['student_id'];
if(!isset($_GET['cid'])){ header('Location: view_companies.php'); exit; }
$cid=(int)$_GET['cid'];
// fetch company and student
$student = mysqli_fetch_assoc(mysqli_query($conn, "SELECT cgpa FROM students WHERE id={$uid}"));
$company = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM companies WHERE id={$cid}"));
if(!$company) { die('Company not found'); }

// check already applied
$exists = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM applications WHERE student_id={$uid} AND company_id={$cid}"));
$msg='';
if($exists){
  $msg = 'You have already applied to this company.';
} else if($student['cgpa'] < $company['criteria']){
  $msg = 'You do not meet the CGPA criteria for this company.';
} else {
  $q = "INSERT INTO applications(student_id, company_id, status) VALUES({$uid},{$cid},'Applied')";
  if(mysqli_query($conn, $q)){
    $msg = 'Application submitted successfully.';
  } else $msg = 'Error: '.mysqli_error($conn);
}
?>
<!doctype html><html><head><meta charset='utf-8'><title>Apply</title><link rel='stylesheet' href='../assets/css/style.css'></head><body>
<div class='container'>
  <h2>Apply to <?php echo e($company['name']); ?></h2>
  <p class='small'>Criteria: <?php echo e($company['criteria']); ?> | Location: <?php echo e($company['location']); ?></p>
  <p><?php echo $msg; ?></p>
  <p><a href='view_companies.php'>Back to Companies</a></p>
</div></body></html>
