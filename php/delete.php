<?php
include 'connect.php';
$conn->select_db($db);
if ($conn->connect_error) 
{
die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['number']) && !empty($_POST['number'])) 
{
$id = intval($_POST['number']);
$sql = "DELETE FROM $table WHERE id = ?";
if ($stmt = $conn->prepare($sql)) 
{
$stmt->bind_param("i", $id);
if ($stmt->execute()) 
{
header("Location: admin.php?deletesuccess=true");
} 
else 
{
echo "Error: " . $stmt->error;
}
$stmt->close();
} 
else 
{
echo "Error preparing statement: " . $conn->error;
}
}
else
{
header("Location: admin.php?deleteerror=true");
}
$conn->close();
?>
