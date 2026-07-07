<!DOCTYPE html>
<html>
<head>
    <title>Placement Summary</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        h2 { text-align: center; margin-top: 30px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td {
            border: 1px solid #333;
            padding: 10px;
            text-align: center;
        }
        th { background: #0066cc; color: white; }

        input, select { width: 100%; padding: 6px; }

        @media print {
            button { display: none; }
            input, select { border: none; padding: 0; }
        }
        .btn {
            background: green;
            color: #fff;
            padding: 10px 25px;
            border: none;
            margin-top: 10px;
            cursor: pointer;
            border-radius: 5px;
        }
        @media print {
    button { display: none; }
    input, select { border: none; }
}
@media print {
    tr.empty-row {
        display: none !important;
    }
}
    </style>
</head>
<body>

<button onclick="window.print()" class="btn">🖨 Print Summary</button>

<h2>Placement Summary Report</h2>

<form method="post">

<!-- ================= BRANCH TABLE ================= -->
<table>
    <tr>
        <th>Branch</th>
        <th>Strength</th>
        <th>No. of Companies Visited</th>
        <th>No. of Students Selected</th>
        <th>Girls</th>
        <th>Boys</th>
        <th>Selected in IT</th>
        <th>Selected in Non-IT</th>
    </tr>

    <?php
    $branches = [
        "CSE",
        "ECE",
        "Civil Engineering",
        "Mechanical Engineering"
    ];

    foreach ($branches as $b) {
        echo "
        <tr>
            <td>$b</td>
            <td><input type='number' name='strength_$b' required></td>
            <td><input type='number' name='visited_$b' required></td>
            <td><input type='number' name='selected_$b' required></td>
            <td><input type='number' name='girls_$b' required></td>
            <td><input type='number' name='boys_$b' required></td>
            <td><input type='number' name='it_$b' required></td>
            <td><input type='number' name='nonit_$b' required></td>
        </tr>";
    }
    ?>

    <!-- =============== TOTAL ROW ================= -->
    <tr style="background:#e3f2ff; font-weight:bold;">
        <td>TOTAL</td>
        <td><span id="t_strength">0</span></td>
        <td><input type="number" id="t_visited" name="t_visited"></td>
        <td><span id="t_selected">0</span></td>
        <td><span id="t_girls">0</span></td>
        <td><span id="t_boys">0</span></td>
        <td><span id="t_it">0</span></td>
        <td><span id="t_nonit">0</span></td>
    </tr>

</table>

<br><br>

<!-- =============== COMPANY DETAILS ================ -->
<h2>Company Drive Details</h2>

<table>
    <tr>
        <th>Company Name</th>
        <th>Mode</th>
        <th>Date</th>
    </tr>

    <?php for ($i = 1; $i <= 10; $i++): ?>
    <tr>
        <td><input type="text" name="company<?= $i ?>"></td>
        <td>
            <select name="mode<?= $i ?>">
                <option value="">--Select--</option>
                <option>Online</option>
                <option>Offline</option>
            </select>
        </td>
        <td><input type="date" name="date<?= $i ?>"></td>
    </tr>
    <?php endfor; ?>
</table>
<button class="btn" >Save Summary</button>
</form>


<script>
// AUTO-CALCULATE TOTAL ROW
function updateTotals() {
    let fields = ["strength", "selected", "girls", "boys", "it", "nonit"];
    let branches = ["CSE", "ECE", "Civil Engineering", "Mechanical Engineering"];

    fields.forEach(f => {
        let total = 0;

        branches.forEach(b => {
            let name = f + "_" + b;
            let val = document.getElementsByName(name)[0].value;
            total += Number(val || 0);
        });

        document.getElementById("t_" + f).innerText = total;
    });
}

// attach listener to all inputs
document.querySelectorAll("input").forEach(inp => {
    inp.addEventListener("input", updateTotals);
});
function hideEmptyCompanyRows() {
    for (let i = 1; i <= 10; i++) {
        let company = document.getElementsByName("company" + i)[0].value.trim();
        let mode = document.getElementsByName("mode" + i)[0].value.trim();
        let date = document.getElementsByName("date" + i)[0].value.trim();

        let row = document.getElementsByName("company" + i)[0].closest("tr");

        if (company === "" && mode === "" && date === "") {
            row.classList.add("empty-row");
        } else {
            row.classList.remove("empty-row");
        }
    }
}

// run before print
window.onbeforeprint = hideEmptyCompanyRows;

// also check when user types
document.querySelectorAll("input, select").forEach(el => {
    el.addEventListener("input", hideEmptyCompanyRows);
});

// SAVE DATA
document.querySelectorAll("input, select").forEach(input => {
    input.value = localStorage.getItem(input.name) || "";

    input.addEventListener("input", function() {
        localStorage.setItem(input.name, this.value);
    });
});

// CLEAR ALL SAVED DATA
function clearData() {
    if (confirm("Do you want to delete all saved summary data?")) {
        localStorage.clear();
        location.reload();
    }
}

</script>
<button type="button" onclick="clearData()" class="btn" style="background:red;">🗑 Delete Saved Data</button>

</body>
</html>