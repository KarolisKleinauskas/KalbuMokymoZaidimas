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

// Check if form is submitted for deletion
if (isset($_POST['delete'])) {
    // Get table name and ID from the form
    $table = $_POST['table'];
    $id = $_POST['id'];

    // Prepare and execute the delete statement
    $sql = "DELETE FROM $table WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
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
    <title>Delete Record</title>
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
    <h2>Delete Record</h2>
    <form action="" method="post">
        <input type="hidden" name="table" value="<?php echo $table; ?>">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="form-group">
            <label for="word">Word:</label>
            <input type="text" class="form-control" id="word" name="word" value="<?php echo $row['word']; ?>" disabled>
        </div>
        <div class="form-group">
            <label for="category">Category:</label>
            <input type="text" class="form-control" id="category" name="category" value="<?php echo $row['category']; ?>" disabled>
        </div>
        <button type="submit" name="delete" class="btn btn-danger">Delete</button>
    </form>
</div>
<!-- Bootstrap JS and jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
