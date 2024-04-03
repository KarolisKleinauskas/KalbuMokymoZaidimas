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

// Get table name and ID from the URL
$table = $_GET['table'];
$id = $_GET['id'];

// Retrieve data based on table name and ID
$sql = "SELECT * FROM $table WHERE id=$id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "0 results";
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Record</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Edit Record</h2>
    <form action="update.php" method="post">
        <input type="hidden" name="table" value="<?php echo $table; ?>">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="form-group">
            <label for="word">Word:</label>
            <input type="text" class="form-control" id="word" name="word" value="<?php echo $row['word']; ?>">
        </div>
        <div class="form-group">
            <label for="category">Category:</label>
            <input type="text" class="form-control" id="category" name="category" value="<?php echo $row['category']; ?>">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
<!-- Bootstrap JS and jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
