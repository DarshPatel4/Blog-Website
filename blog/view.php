<?php include('db.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Post</title>
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
        $id = $_GET['id'];
        $sql = "SELECT * FROM posts WHERE id = $id";
        $result = $conn->query($sql);
        $post = $result->fetch_assoc();
        ?>
        <div class="card mb-4 border-0 shadow">
            <?php if ($post['image']) { ?>
                <img src="<?php echo $post['image']; ?>" class="card-img-top" alt="Post Image">
            <?php } ?>
            <div class="card-body">
                <h1 class="card-title"><?php echo $post['title']; ?></h1>
                <p class="card-text"><?php echo nl2br($post['content']); ?></p>
                <p class="card-text"><small class="text-muted">Posted on <?php echo $post['created_at']; ?></small></p>
                <a href="update.php?id=<?php echo $post['id']; ?>" class="btn btn-secondary">Edit</a>
                <a href="delete.php?id=<?php echo $post['id']; ?>" class="btn btn-danger">Delete</a>
                <a href="index.php" class="btn btn-primary">Back to Home</a>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
