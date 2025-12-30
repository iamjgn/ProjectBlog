<?php
include 'credentials.php';
$host = $db_user_hostname;
$user = $db_user_username;
$pass = $db_user_password;
$db = 'blog_db';
$table = "blog_posts";
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) 
{
die("Connection failed: " . $conn->connect_error);
}
?>