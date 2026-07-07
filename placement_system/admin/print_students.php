<?php
include "../config.php";

$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : "";
$status_filter = isset($_GET['status']) ? mysqli_real_escape_string($conn, $_GET['status']) : "";

$query = "SELECT * FROM students WHERE 1";

if ($search != "") {
    $query .= " AND (name LIKE '%$search%' OR roll_no LIKE '%$search%' OR department LIKE '%$search%')";
}

if ($status_filter != "") {
    $query .= " AND status = '$status_filter'";
}

$query .= " ORDER BY department, name";

$result = mysqli_query($conn, $query);
$sn = 1;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Students Report</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        h2 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td {
            border: 1px solid #333;
            padding: 10px;
            text-align: left;
        }
        th { background: #0066cc; color: white; }
        @media print {
            button { display: none; }
        }
        .print-btn {
            padding: 10px 20px;
            background: green;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<button onclick="window.print()" class="print-btn">🖨 Print</button>

<h2>Students Report</h2>

<table>
<tr>
    <th>Sl.No</th>
    <th>Name</th>
    <th>Email</th>
    <th>Phone</th>
    <th>Gender</th>
    <th>Department</th>
    <th>CGPA</th>
</tr>

<?php while ($row = mysqli_fetch_assoc($result)) : ?>
<tr>
    <td><?= $sn++ ?></td>
    <td><?= $row['name'] ?></td>
    <td><?= $row['email'] ?></td>
    <td><?= $row['phone'] ?></td>
    <td><?= $row['gender'] ?></td>
    <td><?= $row['department'] ?></td>
    <td><?= $row['cgpa'] ?></td>
</tr>
<?php endwhile; ?>

</table>

</body>
</html>