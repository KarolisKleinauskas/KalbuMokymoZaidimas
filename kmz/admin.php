<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        form {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "kmz";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $table = isset($_GET['table']) ? $_GET['table'] : 'CategoryWords';
    $filter = isset($_GET['filter']) ? $_GET['filter'] : '';
    $sort = isset($_GET['sort']) ? $_GET['sort'] : 'id';

    $sql = "SELECT * FROM $table";

    // Apply filter if provided
    if (!empty($filter) && $filter !== 'All') {
        $sql .= " WHERE category = '$filter'";
    }

    // Apply sorting
    $sql .= " ORDER BY $sort";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table class='table'><thead class='thead-light'><tr><th>ID</th><th>Word</th><th>Category</th><th>Actions</th></tr></thead><tbody>";
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["id"] . "</td><td>" . $row["word"] . "</td><td>" . $row["category"] . "</td><td><a href='edit.php?table=" . $table . "&id=" . $row["id"] . "' class='btn btn-primary'>Edit</a> <a href='delete.php?table=" . $table . "&id=" . $row["id"] . "' class='btn btn-danger'>Delete</a></td></tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "0 results";
    }
    $conn->close();
    ?>
    <form method="get" action="" class="mb-4">
        <div class="form-group">
            <label for="table">Select a table:</label>
            <select id="table" name="table" onchange="changeTable()" class="form-control">
                <option value="CategoryWords" <?php if ($table === "CategoryWords") echo "selected"; ?>>CategoryWords</option>
                <option value="CategoryWordsFrench" <?php if ($table === "CategoryWordsFrench") echo "selected"; ?>>CategoryWordsFrench</option>
                <option value="CategoryWordsGerman" <?php if ($table === "CategoryWordsGerman") echo "selected"; ?>>CategoryWordsGerman</option>
                <option value="CategoryWordsSpanish" <?php if ($table === "CategoryWordsSpanish") echo "selected"; ?>>CategoryWordsSpanish</option>
            </select>
        </div>
        <div class="form-group">
            <label for="filter">Filter by Category:</label>
            <select id="filter" name="filter" onchange="submitForm()" class="form-control">
                <option value="All" <?php if ($filter === "All") echo "selected"; ?>>All</option>
                <option value="1" <?php if ($filter === "1") echo "selected"; ?>>1</option>
                <option value="2" <?php if ($filter === "2") echo "selected"; ?>>2</option>
                <option value="3" <?php if ($filter === "3") echo "selected"; ?>>3</option>
                <option value="4" <?php if ($filter === "4") echo "selected"; ?>>4</option>
            </select>
        </div>
        <div class="form-group">
            <label for="sort">Sort by:</label>
            <select id="sort" name="sort" onchange="submitForm()" class="form-control">
                <option value="id" <?php if ($sort === "id") echo "selected"; ?>>ID</option>
                <option value="word" <?php if ($sort === "word") echo "selected"; ?>>Word</option>
                <option value="category" <?php if ($sort === "category") echo "selected"; ?>>Category</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <a href="add_word.php?table=<?php echo $table; ?>" class="btn btn-success">Add New Word</a>
</div>
<!-- Bootstrap JS and jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    function changeTable() {
        var selectedTable = document.getElementById("table").value;
        window.location.href = "admin.php?table=" + selectedTable;
    }

    function submitForm() {
        document.forms[0].submit();
    }
</script>
</body>
</html>
