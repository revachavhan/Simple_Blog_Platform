<?php
session_start();
require_once "connection.php";

$search = $_GET['search'] ?? '';
$sql = "SELECT * FROM blogs WHERE blog_name LIKE ? OR blog_content LIKE ? ORDER BY id DESC";
$stmt = mysqli_prepare($link, $sql);
$param = "%$search%";
mysqli_stmt_bind_param($stmt, "ss", $param, $param);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>
<!DOCTYPE html>
<html>
<head>
    <title>REVA's Blog Platform</title>
    <link rel="stylesheet" href="assets/vendors/bootstrap/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f9f9f9;
        }
        .blog-content p {
            margin-bottom: 0.8rem;
        }
        .blog-content img {
            max-width: 100%;
            border-radius: 8px;
        }
        .blog-content ol, .blog-content ul {
            padding-left: 1.5rem;
        }
    </style>
</head>
<body class="container mt-5">

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4 rounded shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="index.php">REVA Blog</a>
            <a href="create.php" class="btn btn-outline-light ms-auto">+ Add Blog</a>
        </div>
    </nav>

    <!-- Header -->
    <div class="mb-4 text-center">
        <h1 class="display-5 fw-bold">📝 REVA's Blog Platform</h1>
        <p class="lead text-muted">A simple blog system using PHP, MySQL & CKEditor</p>
        <hr>
    </div>

    <!-- Search Form -->
    <form method="get" class="mb-3 d-flex" role="search">
    <input type="text" name="search" class="form-control me-2" placeholder="Search blog posts..." value="<?= htmlspecialchars($search) ?>">
    <button type="submit" class="btn btn-primary">Search</button>
</form>


    <!-- Blog Posts -->
    <?php while($row = mysqli_fetch_assoc($result)) { ?>
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <h4><?= htmlspecialchars($row['blog_name']) ?></h4>
                <p><small class="text-muted">Posted on: <?= htmlspecialchars($row['created_at']) ?></small></p>
                <?php if ($row['image']): ?>
                    <img src="uploads/<?= htmlspecialchars($row['image']) ?>" class="img-fluid rounded mb-3" style="max-height: 300px;" />
                <?php endif; ?>

                <!-- CKEditor HTML content rendering -->
                <div class="blog-content"><?= $row['blog_content'] ?></div>

                <div class="mt-3">
                    <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                </div>
            </div>
        </div>
    <?php } ?>

    <!-- Footer -->
    <footer class="text-center mt-5 text-muted">
        <hr>
        <p>&copy; <?= date('Y') ?> REVA's Blog System | Built with ❤️ using PHP & MySQL</p>
    </footer>

</body>
</html>
