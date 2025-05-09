<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Blog | Reset</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body class="bg-dark">
<div class="container-fluid row align-items-center sticky-top bg-dark">
<div class="col-6 text-left text-primary">
<h1>Blog</h1>
</div>
<div class="col-6 text-right text-primary">
<h2>Reset Page</h2>
</div>
</div>
<?php
include 'php/connect.php';
try
{
$sql = "DROP DATABASE $db";
if ($conn->query($sql) === TRUE) 
{
echo "<div class='alert alert-success alert-dismissible fade show text-center'>Database has been deleted successfully.<button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
}
} 
catch (mysqli_sql_exception $e) 
{
echo "<div class='alert alert-info alert-dismissible fade show text-center'>Database does not exist.<button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
}
$conn->close();
$file = 'misc/counter.txt';
if (file_exists($file)) 
{
if (unlink($file)) 
{
echo "<div class='alert alert-success alert-dismissible fade show text-center'>Associated file has been deleted successfully.<button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
} 
else 
{
echo "Error deleting file.";
}
} 
else 
{
echo "<div class='alert alert-info alert-dismissible fade show text-center'>Associated file does not exist.<button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
}
function deleteFolder($folderPath) 
{
if (is_dir($folderPath)) 
{
$files = array_diff(scandir($folderPath), array('.', '..'));
foreach ($files as $file) {
$filePath = $folderPath . DIRECTORY_SEPARATOR . $file;          
if (is_file($filePath)) 
{
unlink($filePath);
}
}
rmdir($folderPath);
echo "<div class='alert alert-success alert-dismissible fade show text-center'>Associated folder has been deleted successfully.<button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
} 
else 
{
echo "<div class='alert alert-info alert-dismissible fade show text-center'>Associated folder does not exist.<button type='button' class='close' data-dismiss='alert'>&times;</button></div>";
}
}
$folderPath = 'uploads';
deleteFolder($folderPath);
?>
<script src="js/jquery.slim.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
