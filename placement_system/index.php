<?php include('config.php'); ?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Placement Management System - GEC Kushalnagar</title>
  <link rel="stylesheet" href="assets/css/style.css">
 
</head>
<body>
  <!-- Simple Top-Right Contact Menu -->
<div class="hamburger" onclick="toggleContact()">☰</div>
<div id="contact-info" class="contact-info">
  <p><strong>For Queries:</strong></p>
  <p>📞 +91 98862 72293</p>
  <p>📧 placementcell@geckushinagar.ac.in</p>
</div>
 <div class="appname"> <h1>🎓CampusHire</h1></div>
  <div class="container">
    <img src="assets/images/logo.jpg" alt="College Logo" width="100" height="100" >
    <h2>Government Engineering College, Kushalnagar</h2>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="links">
      <a href="register.php">Student Register</a>
      <a href="login.php">Student Login</a>
      <a href="admin/login.php">Admin Login</a>
<script>
  function toggleContact() {
    document.getElementById("contact-info").classList.toggle("show");
  }
</script>
   
</body>
</html>
