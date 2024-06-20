<?php

/*******w******** 
    
    Name:
    Date:
    Description:

****************/


require 'connect.php';
require 'authenticate.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $stmt = $pdo->prepare("SELECT title, content FROM posts WHERE id = ?");
    $stmt->execute([$id]);
    $post = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['update'])) {
        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
        $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_STRING);
        if ($title && $content) {
            $stmt = $pdo->prepare("UPDATE posts SET title = ?, content = ? WHERE id = ?");
            $stmt->execute([$title, $content, $id]);
            header('Location: index.php');
            exit;
        } else {
            $error = 'Title and content are required';
        }
    } elseif (isset($_POST['delete'])) {
        $stmt = $pdo->prepare("DELETE FROM posts WHERE id = ?");
        $stmt->execute([$id]);
        header('Location: index.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>Edit this Post</title>
</head>
<body>
    <header>
        <div class="container">
        <h1><a href="index.php">Blog Home</a></h1>
            <h2>Edit Post</h2>
        </div>
    </header>
    <div class="container">
        <?php if (isset($post)): ?>
            <form action="edit.php?id=<?php echo $id; ?>" method="post" class="form">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($post['title']); ?>" required>
                <label for="content">Content:</label>
                <textarea id="content" name="content" required><?php echo htmlspecialchars($post['content']); ?></textarea>
                <button type="submit" name="update">Update</button>
                <button type="submit" name="delete">Delete</button>
            </form>
            <?php if (isset($error)): ?>
                <p><?php echo $error; ?></p>
            <?php endif; ?>
        <?php endif; ?>
    </div>
    <footer>
        <p>Blog &copy; 2024</p>
    </footer>
</body>
</html>
