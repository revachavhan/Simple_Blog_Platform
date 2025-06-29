<?php
session_start();
require_once "connection.php";

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$result = mysqli_query($link, "SELECT * FROM blogs WHERE id=$id");
$data = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['blog_name'];
    $content = $_POST['blog_content'];

    $sql = "UPDATE blogs SET blog_name=?, blog_content=? WHERE id=?";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "ssi", $name, $content, $id);
    mysqli_stmt_execute($stmt);

    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Blog</title>
    <link rel="stylesheet" href="assets/vendors/bootstrap/css/bootstrap.min.css">
    <script src="https://cdn.ckeditor.com/4.22.1/full-all/ckeditor.js"></script>
</head>
<body class="container mt-5">
    <form method="post">
        <div class="form-group mb-3">
            <label>Blog Name</label>
            <input type="text" name="blog_name" class="form-control" value="<?= htmlspecialchars($data['blog_name']) ?>" required>
        </div>
        <div class="form-group mb-3">
            <label>Content</label>
            <textarea name="blog_content" class="form-control" rows="6" required><?= htmlspecialchars($data['blog_content']) ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update Blog</button>
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