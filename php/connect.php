<?php
include 'credentials.php';
$host = $db_admin_hostname;
$user = $db_admin_username;
$pass = $db_admin_password;
$db = "blog_db";
$table = "blog_posts";
$conn = new mysqli($host, $user, $pass);
if ($conn->connect_error) 
{
die("Connection failed: " . $conn->connect_error);
}
?>