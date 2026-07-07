<?php
include('../config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>View Applications - Admin</title>
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
<body class="bg-light">
<div class="container mt-5">
  <h2 class="text-primary mb-4">All Placement Applications</h2>
  <table class="table table-bordered table-striped shadow">
    <thead class="table-dark">
      <tr>
        <th>Student</th>
        <th>Company</th>
        <th>Applied At</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
      // fetch joined data
      $sql = "SELECT a.id AS app_id, s.name AS student_name, c.name AS company_name, a.applied_at, a.status 
              FROM applications a
              JOIN students s ON a.student_id = s.id
              JOIN companies c ON a.company_id = c.id
              ORDER BY a.applied_at DESC";
      $result = mysqli_query($conn, $sql);

      if (!$result) {
        echo "<tr><td colspan='5' class='text-danger'>SQL Error: " . mysqli_error($conn) . "</td></tr>";
      } elseif (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr>
                  <td>{$row['student_name']}</td>
                  <td>{$row['company_name']}</td>
                  <td>{$row['applied_at']}</td>
                  <td><span class='badge bg-" . 
                       ($row['status']=='Selected'?'success':($row['status']=='Rejected'?'danger':'secondary')) .
                       "'>{$row['status']}</span></td>
                  <td>
                    <a href='update_status.php?id={$row['app_id']}' class='btn btn-sm btn-primary'>Update</a>
                  </td>
                </tr>";
        }
      } else {
        echo "<tr><td colspan='5' class='text-center'>No applications found.</td></tr>";
      }
      ?>
    </tbody>
  </table>

  <a href="dashboard.php" class="btn btn-secondary mt-3">⬅ Back to Dashboard</a>
</div>
</body>
</html>