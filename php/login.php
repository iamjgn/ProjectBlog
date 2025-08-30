<?php
session_start();
include 'credentials.php';
$valid_username = $username;
$hashed_password = password_hash($password, PASSWORD_BCRYPT);
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
$input_username = $_POST['username'];
$input_password = $_POST['password'];
if ($input_username === $valid_username && password_verify($input_password, $hashed_password)) 
{
$_SESSION['loggedin'] = true;
header("Location: admin.php");
exit();
} 
else 
{
header("Location: ../index.php?error=true");
exit();
}
}
?>
