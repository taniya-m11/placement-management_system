<?php include('check_auth.php'); include('../config.php'); ?>
<!doctype html><html><head><meta charset='utf-8'><title>Manage Companies</title><link rel='stylesheet' href='../assets/css/style.css'><style>
  body {font-family: Arial, sans-serif; background-color: #bcc2caff;}
  .container {max-width: 900px; margin: 50px auto; background: #9ca8dd96; padding: 20px; border-radius: 10px;}
  table {width: 100%; border-collapse: collapse;}
  th, td {padding: 10px; border: 1px solid #ccc; text-align: left;}
  th {background-color: #007bff; color: #fff;}
  a.btn {padding: 5px 10px; border-radius: 5px; text-decoration: none;}
  .apply {background-color: #28a745; color: white;}
  .applied {background-color: gray; color: white; pointer-events: none;}
</style></head><body>
<div class='container'>
  <h2>Companies</h2>
  <p><a href="add_company.php" class="btn">Add Company</a> <a href="dashboard.php">Back</a></p>
  <?php
  // handle delete
  if(isset($_GET['delete'])){
    $id=(int)$_GET['delete'];
    mysqli_query($conn, "DELETE FROM companies WHERE id={$id}");
    echo "<p class='small'>Deleted.</p>";
  }
  $res = mysqli_query($conn, "SELECT * FROM companies ORDER BY created_at DESC");
  ?>
  <table class='table'>
    <tr><th>Name</th><th>Criteria</th><th>Location</th><th>Package</th><th>Actions</th></tr>
    <?php while($c=mysqli_fetch_assoc($res)){ ?>
    <tr>
      <td><?php echo e($c['name']); ?></td>
      <td><?php echo e($c['criteria']); ?></td>
      <td><?php echo e($c['location']); ?></td>
      <td><?php echo e($c['package']); ?></td>
      <td>
        <a href="edit_company.php?id=<?php echo $c['id']; ?>">Edit</a> |
        <a href="?delete=<?php echo $c['id']; ?>" onclick="return confirm('Delete?')">Delete</a> |
        <a href="view_applications.php?cid=<?php echo $c['id']; ?>">Applications</a>
      </td>
    </tr>
    <?php } ?>
  </table>
</div></body></html>
