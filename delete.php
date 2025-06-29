<?php
session_start();
require_once "connection.php";

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sql = "DELETE FROM blogs WHERE id=?";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Delete Blog</title>
    <link rel="stylesheet" href="assets/vendors/bootstrap/css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <form method="post">
        <div class="card">
            <div class="card-body">
                <h5>Are you sure you want to delete this blog?</h5>
                <a href="index.php" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-danger">Delete Blog</button>
            </div>
        </div>
    </form>
</body>
</html>