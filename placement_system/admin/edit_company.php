<?php include('check_auth.php'); include('../config.php');
$msg=''; $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$company = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM companies WHERE id={$id}"));
if(!$company){ die('Not found'); }
if($_SERVER['REQUEST_METHOD']=='POST'){
  $name=mysqli_real_escape_string($conn,$_POST['name']);
  $desc=mysqli_real_escape_string($conn,$_POST['description']);
  $criteria=floatval($_POST['criteria']);
  $location=mysqli_real_escape_string($conn,$_POST['location']);
  $package=mysqli_real_escape_string($conn,$_POST['package']);
  $q = "UPDATE companies SET name='{$name}', description='{$desc}', criteria={$criteria}, location='{$location}', package='{$package}' WHERE id={$id}";
  if(mysqli_query($conn,$q)) $msg='Updated';
  else $msg='Error: '.mysqli_error($conn);
  $company = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM companies WHERE id={$id}"));
}
?>
<!doctype html><html><head><meta charset='utf-8'><title>Edit Company</title><link rel='stylesheet' href='../assets/css/style.css'></head><body>
<div class='container'><h2>Edit Company</h2>
<form class='form' method='post'>
  <label>Name</label><input class='input' name='name' value='<?php echo e($company['name']); ?>' required>
  <label>Description</label><textarea class='input' name='description'><?php echo e($company['description']); ?></textarea>
  <label>CGPA Criteria</label><input class='input' name='criteria' value='<?php echo e($company['criteria']); ?>' required>
  <label>Location</label><input class='input' name='location' value='<?php echo e($company['location']); ?>'>
  <label>Package</label><input class='input' name='package' value='<?php echo e($company['package']); ?>'>
  <button class='btn' type='submit'>Save</button>
</form>
<p class='small'><?php echo $msg; ?></p>
<p><a href='companies.php'>Back</a></p>
</div></body></html>
