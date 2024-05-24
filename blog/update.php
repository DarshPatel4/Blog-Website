<?php include('db.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="index.php">MyBlogWeb</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="create.php">Create New Post</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "SELECT * FROM posts WHERE id = $id";
            $result = $conn->query($sql);
            $post = $result->fetch_assoc();
        }

        if (isset($_POST['update'])) {
            $id = $_POST['id'];
            $title = $_POST['title'];
            $content = $_POST['content'];
            $image = $_FILES['image']['name'];
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($image);

            if ($image) {
                if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                    $sql = "UPDATE posts SET title='$title', content='$content', image='$target_file' WHERE id=$id";
                }
            } else {
                $sql = "UPDATE posts SET title='$title', content='$content' WHERE id=$id";
            }

            if ($conn->query($sql) === TRUE) {
                header("Location: view.php?id=$id");
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
        ?>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h2 class="text-center mb-4">Edit Post</h2>
                <form action="update.php?id=<?php echo $post['id']; ?>" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $post['id']; ?>">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" class="form-control" value="<?php echo $post['title']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="content">Content</label>
                        <textarea name="content" class="form-control" rows="10" required><?php echo $post['content']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" name="image" class="form-control-file">
                        <?php if ($post['image']) { ?>
                            <img src="<?php echo $post['image']; ?>" class="img-fluid mt-2" alt="Post Image">
                        <?php } ?>
                    </div>
                    <button type="submit" name="update" class="btn btn-primary btn-block">Update</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
