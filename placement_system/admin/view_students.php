<?php 
include('check_auth.php'); 
include('../config.php');

// 🔍 Handle search query and filter
$search = '';
$status_filter = '';

if (isset($_GET['search']) && $_GET['search'] !== '') {
  $search = mysqli_real_escape_string($conn, $_GET['search']);
}

if (isset($_GET['status']) && $_GET['status'] !== '') {
  $status_filter = mysqli_real_escape_string($conn, $_GET['status']);
}

$query = "
  SELECT * FROM students 
  WHERE (name LIKE '%$search%' OR roll_no LIKE '%$search%' OR department LIKE '%$search%')
";

if ($status_filter !== '') {
  $query .= " AND status = '$status_filter'";
}

$query .= " ORDER BY created_at DESC";
$res = mysqli_query($conn, $query);
?>
<!doctype html>
<html>
<head>
<meta charset='utf-8'>
<title>All Students</title>
<link rel='stylesheet' href='../assets/css/style.css'>
<style>
  body {
    font-family: Arial, sans-serif;
    background-color: #f4f6f9;
  }
  .container {
    max-width: 900px;
    margin: 50px auto;
    background: #9ca8dd96;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
  }
  table {
    width: 100%;
    border-collapse: collapse;
  }
  th, td {
    padding: 10px;
    border: 1px solid #ccc;
    text-align: left;
  }
  th {
    background-color: #007bff;
    color: #fff;
  }

  /* Search bar and filter icon */
  .search-box {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 10px;
    position: relative;
    margin-bottom: 25px;
  }
  .search-box input[type="text"] {
    padding: 10px 15px;
    width: 300px;
    border: 2px solid #007bff;
    border-radius: 30px;
    outline: none;
    transition: 0.3s;
    font-size: 15px;
  }
  .search-box input[type="text"]:focus {
    box-shadow: 0 0 8px #007bff;
    border-color: #0056b3;
  }
  .search-box button {
    background: linear-gradient(135deg, #007bff, #004b9b);
    color: white;
    border: none;
    padding: 10px 18px;
    border-radius: 30px;
    cursor: pointer;
    font-weight: bold;
    transition: 0.3s;
  }
  .search-box button:hover {
    background: linear-gradient(135deg, #0056b3, #003e82);
    transform: scale(1.05);
  }

  /* ⚙ Filter icon */
  .filter-icon {
    background: #f5f8fcff;
    color: white;
    border-radius: 50%;
    width: 38px;
    height: 38px;
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
    font-size: 18px;
    border: none;
    transition: 0.3s;
  }
  .filter-icon:hover {
    background: #e1e3e4ff;
  }

  /* Popup for filter */
  .filter-popup {
    position: absolute;
    top: 50px;
    right: -10px;
    background: white;
    border: 1px solid #ccc;
    border-radius: 8px;
    padding: 10px;
    display: none;
    box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    z-index: 10;
  }
  .filter-popup label {
    display: block;
    margin: 2px 0;
    cursor: pointer;
  }
  .filter-popup button {
    margin-top: 10px;
    padding: 5px 10px;
    border: none;
    background: #007bff;
    color: white;
    border-radius: 5px;
    cursor: pointer;
  }
  h2 {
    text-align: center;
    color: #f4f8feff;
    font-family: 'Segoe UI', sans-serif;
  }
</style>
</head>
<body>
<div class='container'>
  <h2>Students</h2>
  <p><a href='dashboard.php'>Back</a></p>

  <!-- 🔍 Search + ⚙ Filter Icon -->
  <form class="search-box" method="get">
    <input type="text" name="search" placeholder="🔍 Search by name, roll or department" value="<?php echo htmlspecialchars($search); ?>">
    <button type="submit">Search</button>

    <!-- ⚙ Filter Icon -->
    <div class="filter-icon" onclick="toggleFilter()">🔽</div>

    <!-- Hidden Filter Box -->
    <div class="filter-popup" id="filterBox">
      <label><input type="radio" name="status" value="" <?php if($status_filter=='') echo 'checked'; ?>> All</label>
      <label><input type="radio" name="status" value="Placed" <?php if($status_filter=='Placed') echo 'checked'; ?>> ✅ Placed</label>
      <label><input type="radio" name="status" value="Not Placed" <?php if($status_filter=='Not Placed') echo 'checked'; ?>> ❌ Not Placed</label>
      <button type="submit">Apply</button>
    </div>
  </form>
<a href="print_students.php?search=<?= $search ?>&status=<?= $status_filter ?>" target="_blank"
   style="padding:10px 15px; background:#007bff; color:white; border-radius:5px; text-decoration:none;">
   🖨 Print All Students
</a>
  <!-- 📋 Students Table -->
  <table border="1">
<tr>
    <th>S.no</th>
    <th>Name</th>
    <th>Email</th>
    <th>Phone</th>
    <th>Gender</th>
    <th>Department</th>
    <th>CGPA</th>
    <th>Status</th>
    <th>Resume</th>
  
</tr>

<?php
$sn=1;
$result = $res;

while ($row = mysqli_fetch_assoc($result)) {
    echo "
    <tr>
        <td>{$sn}</td>
        <td>{$row['name']}</td>
        <td>{$row['email']}</td>
        <td>{$row['phone']}</td>
        <td>{$row['gender']}</td>
        <td>{$row['department']}</td>
        <td>{$row['cgpa']}</td>
        <td>{$row['status']}</td>
        <td><a href='../uploads/{$row['resume']}' target='_blank'>View</a></td>
 
    </tr>";
    $sn++;
}
?>
</table> 
</div>

<script>
function toggleFilter() {
  const box = document.getElementById("filterBox");
  box.style.display = box.style.display === "block" ? "none" : "block";
}
</script>

</body>
</html>