<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
$title = trim($_POST['title']);
$content = trim($_POST['content']);
$errors = [];
if (empty($title)) 
{
$errors[] = "Title is required.";
}
if (empty($content)) 
{
$errors[] = "Content is required.";
}
if (empty($errors)) 
{
include 'upload.php';
} 
else 
{
foreach ($errors as $error) 
{
header("Location: admin.php?error=true");
}
}
}
?>
