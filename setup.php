<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Blog | Setup</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body class="bg-dark">
<div class="container-fluid row align-items-center sticky-top bg-dark">
<div class="col-6 text-left text-primary">
<h1>Blog</h1>
</div>
<div class="col-6 text-right text-primary">
<h2>Setup Page</h2>
</div>
</div>
<?php
include 'php/connect.php';
$db_check_query = "SHOW DATABASES LIKE '$db'";
$result = $conn->query($db_check_query);
if ($result->num_rows == 0) 
{
$create_db_query = "CREATE DATABASE $db";
if ($conn->query($create_db_query) === TRUE) 
{
echo "<div class='alert alert-success alert-dismissible fade show text-center'>Database has been created successfully.<button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
} 
else 
{
die("Error creating database: " . $conn->error);
}
} 
else 
{
echo "<div class='alert alert-info alert-dismissible fade show text-center'>Database already exists.<button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
}
$conn->select_db($db);
$table_check_query = "SELECT 1 FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$db' AND TABLE_NAME = '$table'";
$result = $conn->query($table_check_query);
if ($result->num_rows > 0) 
{
echo "<div class='alert alert-info alert-dismissible fade show text-center'>Table already exists. You can proceed to access or manipulate data.<button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
} 
else 
{
$sql = "CREATE TABLE $table (id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, title VARCHAR(50) NOT NULL, content TEXT NOT NULL, image_url TEXT, post_datetime DATETIME)";
if ($conn->query($sql) === TRUE) 
{
echo "<div class='alert alert-success alert-dismissible fade show text-center'>Table has been created successfully.<button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
} 
else 
{
echo "Error creating table: " . $conn->error;
}
}
$conn->close();
$file = 'misc/counter.txt';
if (!file_exists($file)) 
{
file_put_contents($file, "0");
echo "<div class='alert alert-success alert-dismissible fade show text-center'>Required file has been created successfully.<button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
} 
else 
{
echo "<div class='alert alert-info alert-dismissible fade show text-center'>Required file already exists.<button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
}
$folderPath = 'uploads';
if (!is_dir($folderPath)) 
{
mkdir($folderPath, 0777, true);
echo "<div class='alert alert-success alert-dismissible fade show text-center'>Required folder has been created successfully.<button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
} 
else 
{
echo "<div class='alert alert-info alert-dismissible fade show text-center'>Required folder already exists.<button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
}
?>
<script src="js/jquery.slim.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>