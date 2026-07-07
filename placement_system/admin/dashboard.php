<?php include('check_auth.php'); include('../config.php'); ?>
<!doctype html><html><head><meta charset='utf-8'><title>Admin Dashboard</title><link rel='stylesheet' href='../assets/css/style.css'></head><body>
<div class='container'>
  <h2>Admin Dashboard - GEC Kushalnagar</h2>
  <?php
  $totalStudents = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM students"));
  $totalCompanies = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM companies"));
  $placed = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM students WHERE status='Placed'"));
  echo "<p>Total Students: <strong>{$totalStudents}</strong></p>";
  echo "<p>Total Companies: <strong>{$totalCompanies}</strong></p>";
  echo "<p>Placed Students: <strong>{$placed}</strong></p>";
  ?>
  <nav>
    <a href='companies.php'><button class="m">Manage Companies</button></a>
    <a href='view_students.php'><button class="m">View Students</button></a>
    <a href='view_applications.php'><button class="m">View Applications</button></a>
    <a href="summary.php"><button class="m">Placement Summary</button></a>
    <a href='logout.php'><button class="m">Logout</button></a>
  </nav>
</div></body></html>