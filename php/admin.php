<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) 
{
header("Location: ../index.php");
exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Blog | Admin</title>
<link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body class="bg-dark">
<div class="container-fluid row align-items-center sticky-top bg-dark">
<div class="col-6 text-left text-primary">
<h1>Blog</h1>
</div>
<div class="col-6 text-right">
<form action="logout.php" method="POST">
<button type="submit" class="btn btn-primary">Log out</button>
</form>
</div>
</div>
<?php
$uploadSuccessMessage = isset($_GET['uploadsuccess']) && $_GET['uploadsuccess'] == 'true';
$uploadErrorMessage = isset($_GET['uploaderror']) && $_GET['uploaderror'] == 'true';
$deleteSuccessMessage = isset($_GET['deletesuccess']) && $_GET['deletesuccess'] == 'true';
$deleteErrorMessage = isset($_GET['deleteerror']) && $_GET['deleteerror'] == 'true';
if ($uploadSuccessMessage)
{
echo "<div class='alert alert-success alert-dismissible fade show text-center'><strong>Success!</strong> Post uploaded successfully.<button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
}
if ($uploadErrorMessage)
{
echo "<div class='alert alert-danger alert-dismissible fade show text-center'><strong>Error!</strong> Post upload failed.<button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
}
if ($deleteSuccessMessage)
{
echo "<div class='alert alert-success alert-dismissible fade show text-center'><strong>Success!</strong> Post deleted successfully.<button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
}
if ($deleteErrorMessage)
{
echo "<div class='alert alert-danger alert-dismissible fade show text-center'><strong>Error!</strong> Post delete failed.<button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
}
?>
<div class="container-fluid mt-5">
<div class="jumbotron">
<h2>Admin Dashboard</h2>
<br>
<?php
include 'credentials.php';
echo "<p><strong>Username: </strong>$username<br><strong>Password: </strong>$password</p>";
include 'user.php';
$sql = "SELECT COUNT(*) AS total_rows FROM $table";
$result = $conn->query($sql);
if ($result) 
{
$row = $result->fetch_assoc();
$totalRows = $row['total_rows'];
echo "<p><strong>Total Articles Published: </strong>" . $totalRows . "</p>";
} 
else 
{
echo "<p><strong>Total Articles Published: <strong>" . $conn->error . "</p>";
}
$conn->close();
?>
</div>
</div>
<div class="container-fluid mt-5">
<div class="row d-flex justify-content-center align-items-start" id="accordion">
<div class="col-md-4 mx-4 my-4 py-4 border border-light rounded">
<div class="container-fluid text-center text-light"><h2>Create Your Blog Post</h2></div>
<div class="container-fluid mt-4">
<div class="container-fluid text-center">  
<button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#create">Click Here&#33;</button>
</div>
<div id="create" class="container-fluid collapse" data-parent="#accordion">
<form action="validation.php" method="POST" enctype="multipart/form-data">
<div class="form-group">
<label for="title" class="text-light">Title</label>
<input type="text" class="form-control" placeholder="Enter title..." name="title" id="title" required>
</div>
<div class="form-group">
<label for="content" class="text-light">Content</label>
<textarea class="form-control" placeholder="Compose..." rows="5" name="content" id="content" required></textarea>
</div>
<div class="form-group">
<div class="custom-file">
<label class="custom-file-label" for="image">Choose an image (optional)</label>
<input type="file" class="custom-file-input" name="image" id="image">
</div>
</div>
<div class="form-group">
<button type="submit" class="btn btn-primary btn-block">Publish</button>
<button type="reset" class="btn btn-outline-light btn-block">Clear</button>
</div>
</form>
</div>
</div>
</div>
<div class="col-md-4 mx-4 my-4 py-4 border border-light rounded">
<div class="container-fluid text-center text-light"><h2>Delete Your Blog Post</h2></div>
<div class="container-fluid mt-4">
<div class="container-fluid text-center">  
<button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#delete">Click Here&#33;</button>
</div>
<div id="delete" class="container-fluid collapse" data-parent="#accordion">
<form action="delete.php" method="POST">
<div class="form-group">
<label for="number" class="text-light">Delete Post</label>
<input type="text" class="form-control" placeholder="Enter Post ID to delete" name="number" id="number" required>
</div>
<div class="form-group">
<button type="submit" class="btn btn-primary btn-block">Delete</button>
<button type="reset" class="btn btn-outline-light btn-block">Clear</button>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
<script src="../js/jquery.slim.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script>
$(".custom-file-input").on("change", function() {
var fileName = $(this).val().split("\\").pop();
$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>
</body>
</html>