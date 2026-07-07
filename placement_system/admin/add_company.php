<?php include('check_auth.php'); include('../config.php'); $msg=''; 
if($_SERVER['REQUEST_METHOD']=='POST'){
  $name=mysqli_real_escape_string($conn,$_POST['name']);
  $desc=mysqli_real_escape_string($conn,$_POST['description']);
  $criteria=floatval($_POST['criteria']);
  $location=mysqli_real_escape_string($conn,$_POST['location']);
  $package=mysqli_real_escape_string($conn,$_POST['package']);
  $q = "INSERT INTO companies(name,description,criteria,location,package) VALUES('{$name}','{$desc}',{$criteria},'{$location}','{$package}')";
  if(mysqli_query($conn,$q)) $msg='Company added';
  else $msg='Error: '.mysqli_error($conn);
}
?>
<!doctype html><html><head><meta charset='utf-8'><title>Add Company</title><link rel='stylesheet' href='../assets/css/style.css'></head><body>
<div class='container'><h2>Add Company</h2>
<form class='form' method='post'>
  <label>Name</label><input class='input' name='name' required>
  <label>Description</label><textarea class='input' name='description'></textarea>
  <label>CGPA Criteria</label><input class='input' name='criteria' required>
  <label>Location</label><input class='input' name='location'>
  <label>Package</label><input class='input' name='package'>
  <button class='btn' type='submit'>Add</button>
</form>
<p class='small'><?php echo $msg; ?></p>
<p><a href='companies.php'>Back</a></p>
</div></body></html>
