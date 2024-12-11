<?php 
include 'includes/db.php';
session_start();

if(isset($_POST['submit'])){
   $post_title =$_POST['title'];
   $post_date = date("Y-m-d");
   $post_content =$_POST['content'];
   $post_image =$_FILES['image']['name'];
   $post_image_temp = $_FILES['image'] ['tmp_name'];

   $file_path = 'C:\Apache24\htdocs\CMS\images';
   move_uploaded_file(($post_image_temp), "$file_path/$post_image");


   // SQL query for insertion
$query = 'INSERT INTO test.post (post_cat_id, post_title, post_author, post_date, post_image, post_content) 
VALUES (?, ?, ?, ?, ?, ?)';

// Prepare the statement
$stmt = mysqli_prepare($connection, $query);

if ($stmt) {
// Bind parameters - 'i' for integer, 's' for string
mysqli_stmt_bind_param($stmt, 'isssss', $post_cat_id, $post_title, $_SESSION['username'], $post_date, $post_image, $post_content);

// Execute the statement
$result = mysqli_stmt_execute($stmt);

// Check if the insert was successful
if (!$result) {

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

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Home</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#">About</a>
                    </li>
                    <li>
                        <a href="#">Services</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-8">

                <!-- Blog Post -->

                <!-- Title -->
                <h1>New Post</h1>
                <hr>

                
 <form method="post" enctype="multipart/form-data">
  <div class="mb-3">
    <label for="title" class="form-label">Title</label>
    <input name="title" type="text" class="form-control" id="title" required><br>
  </div>
  
  <div class="mb-3">
  <label for="formFile" class="form-label">Post Image</label>
  <input name="image" class="form-control" type="file" id="formFile" required><br>
</div>
 <div class="mb-3">
    <label for="content" class="form-label">Post content</label>
    <textarea name="content" type="" class="form-control" required></textarea><br>
  </div>
  
  <button name="submit" type="submit" class="btn btn-primary">Add Post</button>
</form>
                </div>

            </div>

        

</body>

</html>
