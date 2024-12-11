<?php 
include 'db.php';
session_start();

if (isset($_SESSION['username'])) {
    echo $_SESSION['username']; // Display the logged-in user's username
}

if (isset($_POST['submit'])) {
    $post_title = mysqli_real_escape_string($connection, $_POST['title']);
    $post_date = date("Y-m-d");
    $post_content = mysqli_real_escape_string($connection, $_POST['content']);
    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];

    // Specify the directory for file uploads
    $file_path = 'images'; // Make sure the directory exists

    // Check for file upload error
    if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
        move_uploaded_file($post_image_temp, "$file_path/$post_image");
    } else {
        echo "Error uploading the file.";
    }

    // Insert query with the correct number of placeholders
    $query = 'INSERT INTO test.post (post_cat_id, post_title, post_author, post_date, post_image, post_content) 
              VALUES (?, ?, ?, ?, ?, ?)';

    // Prepare the statement
    $stmt = mysqli_prepare($connection, $query);

    if ($stmt) {
        // Set a default category id or get it dynamically if needed
        $post_cat_id = 1; // Example: set default category ID
        // Bind parameters for the prepared statement
        mysqli_stmt_bind_param($stmt, 'isssss', $post_cat_id, $post_title, $_SESSION['username'], $post_date, $post_image, $post_content);

        // Execute the statement
        $result = mysqli_stmt_execute($stmt);

        // Check if the insert was successful
        if ($result) {
            echo 'Data stored successfully';
        } else {
            die('Error: ' . mysqli_error($connection));
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        die('Statement preparation failed: ' . mysqli_error($connection));
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Blog Post - Start Bootstrap Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/blog-post.css" rel="stylesheet">
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Home</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="#">About</a></li>
                    <li><a href="#">Services</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <h1>New Post</h1>
                <hr>

                <form method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input name="title" type="text" class="form-control" id="title"><br>
                    </div>

                    <div class="mb-3">
                        <label for="formFile" class="form-label">Post Image</label>
                        <input name="image" class="form-control" type="file" id="formFile"><br>
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">Post content</label>
                        <textarea name="content" class="form-control"></textarea><br>
                    </div>

                    <button name="submit" type="submit" class="btn btn-primary">Add Post</button>
                </form>
            </div>
        </div>
    </div>

</body>

</html>
