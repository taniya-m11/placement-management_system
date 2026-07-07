<?php 
include('check_auth.php'); 
include('../config.php');

// ✅ Validate ID
$id = isset($_GET['id']) ? (int)$_GET['id'] : ;
if(!$id) die('Invalid Request');

// ✅ Fetch student record
$res = mysqli_query($conn, "SELECT * FROM students WHERE id={$id}");
if(!$res || mysqli_num_rows($res) == 0) die('Student not found');
$student = mysqli_fetch_assoc($res);

$msg = '';


 if(mysqli_query($conn, $update)){
    $msg = '✅ Status updated successfully!';
    // Refresh student info
    $student = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM students WHERE id={$id}"));
  } else {
    $msg = '❌ Error updating: ' . mysqli_error($conn);
  }
}
?>
<!doctype html>
<html>
<head>
<meta charset='utf-8'>
<title>Update Student Status</title>
<link rel='stylesheet' href='../assets/css/style.css'>
<style>
  body {font-family: Arial, sans-serif; background-color: #f4f6f9;}
  .container {
    max-width: 500px; 
    margin: 60px auto; 
    background: #fff; 
    padding: 25px; 
    border-radius: 10px; 
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
  }
  select, button {
    padding: 8px; 
    margin-top: 10px; 
    width: 100%;
  }
  .btn {
    background-color: #007bff; 
    color: white; 
    border: none; 
    cursor: pointer;
  }
  .btn:hover {
    background-color: #0056b3;
  }
  .msg {color: green; margin-top: 10px;}
</style>
</head>
<body>
<div class='container'>
  <h2>Update Status for: <?php echo htmlspecialchars($student['name']); ?></h2>

  <form method='post'>
    <label>Status:</label>
    <select name='status'>
      <option value='Not Placed' <?php if($student['status']=='Not Placed') echo 'selected'; ?>>Not Placed</option>
      <option value='Placed' <?php if($student['status']=='Placed') echo 'selected'; ?>>Placed</option>
      <option value='Pending' <?php if($student['status']=='Pending') echo 'selected'; ?>>Pending</option>
    </select>

    <button type='submit' class='btn'>Save</button>
  </form>

  <?php if($msg){ echo "<p class='msg'>{$msg}</p>"; } ?>

  <p><a href='view_students.php'>← Back to Students</a></p>
</div>
</body>
</html>
