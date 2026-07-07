<?php
include('../config.php');

if (!isset($_GET['id'])) {
  die("Application ID missing.");
}

$app_id = $_GET['id'];

// Fetch current data
$q = mysqli_query($conn, "SELECT a.id, s.name AS student_name, c.name AS company_name, a.status, a.student_id 
                          FROM applications a
                          JOIN students s ON a.student_id = s.id
                          JOIN companies c ON a.company_id = c.id
                          WHERE a.id = $app_id");

if (!$q || mysqli_num_rows($q) == 0) {
  die("Application not found!");
}

$app = mysqli_fetch_assoc($q);

// ✅ FIXED UPDATE SECTION
if (isset($_POST['update'])) {
  $new_status = $_POST['status'];

  $update = mysqli_query($conn, "UPDATE applications SET status='$new_status' WHERE id=$app_id");

  if ($update) {
    $student_id = $app['student_id'];

    // ✅ Update student status correctly for both cases
    if ($new_status == 'Selected') {
      mysqli_query($conn, "UPDATE students SET status='Placed' WHERE id=$student_id");
    } elseif ($new_status == 'Rejected') {
      mysqli_query($conn, "UPDATE students SET status='Not Placed' WHERE id=$student_id");
    }

    echo "<script>alert('Status updated successfully!'); window.location='view_applications.php';</script>";
  } else {
    echo "<div class='alert alert-danger'>Error updating: " . mysqli_error($conn) . "</div>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Update Status</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
  <div class="card shadow p-4">
    <h4 class="text-primary mb-3">Update Status</h4>
    <p><strong>Student:</strong> <?php echo $app['student_name']; ?></p>
    <p><strong>Company:</strong> <?php echo $app['company_name']; ?></p>

    <form method="POST">
      <div class="mb-3">
        <label for="status" class="form-label">Select New Status:</label>
        <select name="status" id="status" class="form-select" required>
          <option value="Selected" <?php if($app['status']=="Selected") echo "selected"; ?>>Selected</option>
          <option value="Rejected" <?php if($app['status']=="Rejected") echo "selected"; ?>>Rejected</option>
        </select>
      </div>
      <button type="submit" name="update" class="btn btn-success">Update Status</button>
      <a href="view_applications.php" class="btn btn-secondary ms-2">Cancel</a>
    </form>
  </div>
</div>
</body>
</html>