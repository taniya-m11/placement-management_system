<?php
include('../config.php'); session_start();
if(!isset($_SESSION['student_id'])) header('Location: ../login.php');
$uid=(int)$_SESSION['student_id'];
$res = mysqli_query($conn, "SELECT a.*, c.name AS company_name FROM applications a JOIN companies c ON a.company_id=c.id WHERE a.student_id={$uid} ORDER BY a.applied_at DESC");
?>
<!doctype html><html><head><meta charset='utf-8'><title>My Applications</title><link rel='stylesheet' href='../assets/css/style.css'><style>
  body {font-family: Arial, sans-serif; background-color: #f4f6f9;}
  .container {max-width: 900px; margin: 50px auto; background: #9ca8dd96; padding: 20px; border-radius: 10px;}
  table {width: 100%; border-collapse: collapse;}
  th, td {padding: 10px; border: 1px solid #ccc; text-align: left;}
  th {background-color: #007bff; color: #fff;}
  a.btn {padding: 5px 10px; border-radius: 5px; text-decoration: none;}
  .apply {background-color: #28a745; color: white;}
  .applied {background-color: gray; color: white; pointer-events: none;}
</style></head><body>
<div class='container'>
  <h2>My Applications</h2>
  <table class='table'>
    <tr><th>Company</th><th>Applied At</th><th>Status</th></tr>
    <?php while($r=mysqli_fetch_assoc($res)){ ?>
    <tr>
      <td><?php echo e($r['company_name']); ?></td>
      <td><?php echo e($r['applied_at']); ?></td>
      <td><?php echo e($r['status']); ?></td>
    </tr>
    <?php } ?>
  </table>
  <p><a href='dashboard.php'>Back</a></p>
</div></body></html>
