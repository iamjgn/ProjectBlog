<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Blog</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body class="bg-dark">
<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) 
{
header("Location: php/admin.php");
exit();
}
$host = 'localhost';
$db = 'blog_db';
$table = 'blog_posts';
$user = 'user';
$pass = '';
try
{
$conn = new mysqli($host, $user, $pass, $db);
$sql = "SELECT id, title, content, image_url, post_datetime FROM $table";
$result = $conn->query($sql);
$errorMessage = isset($_GET['error']) && $_GET['error'] == 'true';
}
catch (mysqli_sql_exception $e)
{
die ("<div class='alert alert-info text-center'><strong>Blog</strong> is offline</div>");
}
?>
<div class="container-fluid row align-items-center sticky-top bg-dark">
<div class="col-6 text-left text-primary">
<h1>Blog</h1>
</div>
<div class="col-6 text-right">
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Admin Login</button>
</div>
</div>
<?php
if ($errorMessage)
{
echo "<div class='alert alert-danger alert-dismissible fade show text-center'><strong>Error!</strong> Invalid username or password.<button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
}
?>
<div class="modal" id="myModal">
<div class="modal-dialog">
<div class="modal-content bg-dark outline-light text-light">
<div class="modal-header d-flex justify-content-center w-100">
<h4 class="modal-title">Admin Login</h4>
</div>
<div class="modal-body">
<form action="php/login.php" method="POST">
<div class="form-group">
<label for="username">Username</label>
<input type="text" class="form-control" placeholder="Enter username" name="username" id="username" required>
</div>
<div class="form-group">
<label for="password">Password</label>
<input type="password" class="form-control" placeholder="Enter password" name="password" id="password" required>
</div>
</div>
<div class="modal-footer">
<button type="submit" class="btn btn-primary">Log in</button>
<button type="button" class="btn btn-outline-light" data-dismiss="modal">Cancel</button>
</div>
</form>
</div>
</div>
</div>
<div class="container-fluid mt-5">
<div class="row">
<?php
if ($result->num_rows > 0) 
{
while ($row = $result->fetch_assoc()) 
{
$image_url = !empty($row['image_url']) ? substr($row['image_url'],3) : 'misc/placeholder-image.webp';
echo '<div class="col-md-4 mb-4">';
echo '<div class="card bg-dark text-light border border-light">';
echo '<img src="' . htmlspecialchars($image_url) . '" class="card-img-top" alt="' . htmlspecialchars($row['image_url']) . '">';
echo '<div class="card-body">';
echo '<h5 class="card-title text-truncate">' . htmlspecialchars($row['title']) . '</h5>';
echo '<p class="card-text text-truncate">' . htmlspecialchars($row['content']) . '</p>';
echo '<div class="d-flex justify-content-start align-items-center" style="height:20px">';
echo '<div class="mr-auto"><p class="card-text text-secondary">' . htmlspecialchars($row["id"]) . ' &vert; ' . htmlspecialchars($row["post_datetime"]) . '</p></div>';
echo '<form action="php/view.php" method="POST">';
echo '<input type="hidden" name="row_id" value="' . htmlspecialchars($row["id"]) . '">';
echo '<div><button type="submit" class="btn btn-primary">View</button></div>';
echo '</form>';
echo '</div>';
echo '</div>';
echo '</div>';
echo '</div>';
}
} 
else 
{
echo "<div style='height:76vh' class='d-flex justify-content-center align-items-center text-light w-100'><h2>No Blog Posts Yet</h2></div>";
}
$conn->close();
?>
</div>
</div>
<script src="js/jquery.slim.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>