<?php
session_start();
require_once "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['blog_name'];
    $content = $_POST['blog_content'];
    $image = "";

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        if (in_array($_FILES["image"]["type"], $allowed_types)) {
            $image = basename($_FILES["image"]["name"]);
            move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/" . $image);
        }
    }

    $sql = "INSERT INTO blogs (blog_name, blog_content, image) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "sss", $name, $content, $image);
    mysqli_stmt_execute($stmt);

    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Blog</title>
    <link rel="stylesheet" href="assets/vendors/bootstrap/css/bootstrap.min.css">
    <script src="https://cdn.ckeditor.com/4.22.1/full-all/ckeditor.js"></script>
</head>
<body class="container mt-5">
    <form method="post" enctype="multipart/form-data">
        <div class="form-group mb-3">
            <label>Blog Name</label>
            <input type="text" name="blog_name" class="form-control" required>
        </div>
        <div class="form-group mb-3">
            <label>Content</label>
            <textarea name="blog_content" class="form-control" rows="6" required></textarea>
        </div>
        <div class="form-group mb-3">
            <label>Image</label>
            <input type="file" name="image" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Create Blog</button>
    </form>

    <script>
        CKEDITOR.replace('blog_content', {
            extraPlugins: 'emoji,colorbutton,font',
            toolbar: [
                { name: 'document', items: ['Source', '-', 'Preview'] },
                { name: 'clipboard', items: ['Cut', 'Copy', 'Paste', '-', 'Undo', 'Redo'] },
                { name: 'styles', items: ['Format', 'Font', 'FontSize'] },
                { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike', '-', 'RemoveFormat'] },
                { name: 'colors', items: ['TextColor', 'BGColor'] },
                { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Blockquote'] },
                { name: 'insert', items: ['Image', 'Table', 'EmojiPanel'] },
                { name: 'tools', items: ['Maximize'] }
            ]
        });
    </script>
</body>
</html>