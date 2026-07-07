<?php
include('../config.php'); 
session_start();

if(!isset($_SESSION['student_id'])) {
    header('Location: ../login.php');
    exit();
}

$uid = (int)$_SESSION['student_id'];
$res = mysqli_query($conn, "SELECT * FROM companies ORDER BY created_at DESC");
?>
<!doctype html>
<html>
<head>
<meta charset='utf-8'>
<title>Available Companies</title>
<link rel='stylesheet' href='../assets/css/style.css'>
<style>
  body {font-family: Arial, sans-serif; background-color: #f4f6f9;}
  .container {max-width: 900px; margin: 50px auto; background: #9ca8dd96; padding: 20px; border-radius: 10px;}
  table {width: 100%; border-collapse: collapse;}
  th, td {padding: 10px; border: 1px solid #ccc; text-align: left;}
  th {background-color: #007bff; color: #fff;}
  a.btn {padding: 5px 10px; border-radius: 5px; text-decoration: none;}
  .apply {background-color: #28a745; color: white;}
  .applied {background-color: gray; color: white; pointer-events: none;}
</style>
</head>
<body>
<div class='container'>
  <h2>Available Companies</h2>

  <table>
    <tr>
      <th>Name</th>
      <th>Criteria</th>
      <th>Location</th>
      <th>Package</th>
      <th>Action</th>
    </tr>

    <?php while($c = mysqli_fetch_assoc($res)){ ?>
      <tr>
        <td><?php echo htmlspecialchars($c['name']); ?></td>
        <td><?php echo htmlspecialchars($c['criteria']); ?></td>
        <td><?php echo htmlspecialchars($c['location']); ?></td>
        <td><?php echo htmlspecialchars($c['package']); ?></td>
        <td>
          <?php
            $cid = (int)$c['id'];
            $check = mysqli_query($conn, "SELECT * FROM applications WHERE student_id=$uid AND company_id=$cid");
            if(mysqli_num_rows($check) > 0){
                echo "<span class='btn applied'>Applied</span>";
            } else {
                echo "<a class='btn apply' href='apply.php?cid=$cid'>Apply</a>";
            }
          ?>
        </td>
      </tr>
    <?php } ?>
  </table>

  <p style='margin-top:20px;'><a href='dashboard.php'>← Back to Dashboard</a></p>
</div>
</body>
</html>