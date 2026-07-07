
<?php
include('config.php');
$msg='';
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['register'])){
  $name=mysqli_real_escape_string($conn,$_POST['name']);
  $roll=mysqli_real_escape_string($conn,$_POST['roll_no']);
  $dept=mysqli_real_escape_string($conn,$_POST['department']);
  $cgpa=floatval($_POST['cgpa']);
  $email=mysqli_real_escape_string($conn,$_POST['email']);
  $password=md5($_POST['password']);
  $phone = mysqli_real_escape_string($conn, $_POST['phone']);
$gender = mysqli_real_escape_string($conn, $_POST['gender']);
  // resume upload
  $resume_path='';
  if(isset($_FILES['resume']) && $_FILES['resume']['error']==0){
    $target_dir = "uploads/resumes/";
    if(!is_dir($target_dir)) mkdir($target_dir, 0755, true);
    $resume_path = $target_dir . time() . '_' . basename($_FILES['resume']['name']);
    move_uploaded_file($_FILES['resume']['tmp_name'], $resume_path);
  }
 $q = "INSERT INTO students(name, roll_no, department, cgpa, email, phone, gender, password, resume) 
      VALUES ('$name', '$roll', '$dept', '$cgpa', '$email', '$phone', '$gender', '$password', '$resume_path')";
  if(mysqli_query($conn,$q)){ $msg='Registration successful. <a href="login.php">Login</a>'; }
  else{ $msg='Error: '.mysqli_error($conn); }
}
?>
<!doctype html><html><head><meta charset='utf-8'><title>Student Register</title><link rel='stylesheet' href='assets/css/style.css'></head><body>
<div class='container'><h2>Student Register</h2>
<form class='form' method='post' enctype='multipart/form-data'>
  <label>Full name</label>
  <input class='input' name='name' placeholder='Full name' required>
  <label>Roll No</label>
  <input class='input' name='roll_no' placeholder='Roll No' required>
  <label>Department</label>
  <input class='input' name='department' placeholder='Department' required>
  <label>CGPA</label>
  <input class='input' name='cgpa' placeholder='CGPA (eg. 8.5)' required>
  <label>Email</label>
  <input class='input' name='email' placeholder='Email' type='email' required>
  <label>Password</label>
  <input class='input' name='password' placeholder='Password' type='password' required>
  <label>Phone Number:</label><br>
<input type="text" name="phone" required><br><br>

<label>Gender:</label><br>
<input type="radio" name="gender" value="Male" required> Male
<input type="radio" name="gender" value="Female"> Female
<input type="radio" name="gender" value="Other"> Other
<br><br>
  <label>Resume (PDF/DOC)</label>
  <input class='input' name='resume' type='file' required>
  <button class='btn' name='register' type='submit'>Register</button>
</form>
<p class='small'><?php echo $msg; ?></p>
<p><a href='index.php'>Back</a></p></div></body></html>