<?php
include 'connect.php';
$conn->select_db($db);
if ($conn->connect_error) 
{
die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
$title = $conn->real_escape_string($_POST['title']);
$content = $conn->real_escape_string($_POST['content']);
include 'counter.php';
$image_url = "";
if (isset($_FILES["image"]) && $_FILES["image"]["error"] === UPLOAD_ERR_OK) 
{
$target_dir = "../uploads/";
$fileExtension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
$newFileName = $counter . '.' . $fileExtension;
$target_file = $target_dir . $newFileName;
if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) 
{
$image_url = $target_file;
} 
else 
{
echo "Sorry, there was an error uploading your file.";
}
}
$sql = "INSERT INTO $table (title, content, image_url, post_datetime) VALUES ('$title', '$content', '$image_url', NOW())";
if ($conn->query($sql) === TRUE) 
{
header("Location: admin.php?uploadsuccess=true");
} 
else 
{
header("Location: admin.php?uploaderror=true");
}
}
$conn->close();
?>
