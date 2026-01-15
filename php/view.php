<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Blog</title>
<link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body class="bg-dark">
<div class="container-fluid row align-items-center sticky-top bg-dark">
<div class="col-6 text-left text-primary">
<h1>Blog</h1>
</div>
<div class="col-6 text-right text-primary">
<a href="../index.php" class="btn btn-primary" role="button">&larr; Back to Home</a>
</div>
</div>
<div class="container">
<?php
include 'user.php';
$sql = "SELECT id, title, content, image_url, post_datetime FROM $table";
$result = $conn->query($sql);
if (isset($_POST['row_id'])) 
{
$row_id = $_POST['row_id'];
$query = "SELECT * FROM $table WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $row_id);
$stmt->execute();
$result = $stmt->get_result();
if ($row = $result->fetch_assoc())
{
$image_url = !empty($row['image_url']) ? substr($row['image_url'],3) : '../misc/placeholder-image.webp';
echo '<div class="container-fluid mt-5 mb-5">';
echo '<div class="card bg-transparent">';
echo '<img src="' . htmlspecialchars($image_url) . '" class="card-img-top" alt="' . htmlspecialchars($row['image_url']) . '">';
echo '<div class="card-body text-light">';
echo '<h3 class="card-title">' . htmlspecialchars($row['title']) . '</h3>';
echo '<p class="card-text">' . htmlspecialchars($row['content']) . '</p>';
echo '<div><p class="card-text text-secondary">' . htmlspecialchars($row["id"]) . ' &vert; ' . htmlspecialchars($row["post_datetime"]) . '</p></div>';
echo '</div>';
echo '</div>';
echo '</div>';
}
}
?>
</div>
</body>
</html>