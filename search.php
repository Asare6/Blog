<!DOCTYPE html>
<html lang="en">

<?php 
session_start();
include 'includes/header.php';
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recent Blogs</title>
    
</head>

<body>
    <!-- Navigation -->
    <?php include 'includes/navigation.php' ?>
    <!-- Page Content -->
    <div class="container">
        <div>
            <div style="display: inline-flex; justify-content: space-between; width: 100%;">
                <div>
                    <h1 class="page-header">
                        Recent Blogs
                    </h1>
                </div>
                <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
                    <div>
                        <h4>Welcome, <?php echo $_SESSION['username'].'!'; ?></h4>
                    </div><br>
                <?php endif; ?>
            </div>

            <div class="row">
                <div class="col-md-8 section-A" style="height: 500px; overflow-y: auto;">
                    <?php
                    include 'includes/db.php';

                    if (isset($_POST['submit'])) {
                        $search = mysqli_real_escape_string($connection, $_POST['search']);
                        $query = "SELECT * FROM test.post WHERE post_title LIKE '%$search%'";
                        $search_query = mysqli_query($connection, $query);

                        if (!$search_query) {
                            die('Query failed: ' . mysqli_error($connection));
                        }

                        $count = mysqli_num_rows($search_query);
                        if ($count == 0) {
                            echo 'No data found';
                        } else {
                            
                        }
                    } else {
                        $query = "SELECT * FROM test.post ORDER BY post_date DESC";
                        $search_query = mysqli_query($connection, $query);
                    }

                    while ($row = mysqli_fetch_assoc($search_query)) {
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_content = $row['post_content'];
                        $post_image = $row['post_image'];
                    ?>

                        <!-- First Blog Post -->
                        <h2>
                            <a href="#"><?php echo $post_title ?></a>
                        </h2>
                        <p class="lead">
                            by <a href="index.php"><?php echo $post_author ?></a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
                        <hr>
                        <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="" style="width: 600px; height: 500px;">
                        <hr>
                        <p><?php echo $post_content ?></p>
                        <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a><br>

                        <ul class="pager">
                            <li class="previous">
                                <a href="#">&larr; Older</a>
                            </li>
                            <li class="next">
                                <a href="#">Newer &rarr;</a>
                            </li>
                        </ul>
                        <hr>

                    <?php
                    }
                    ?>
                </div>

                <!-- Pager Section (Section-B) -->
                <div class="col-md-4 section-B">
                </div>
                <!-- End of .row -->

                <!-- Blog Sidebar Widgets Column -->
                <?php include 'includes/sideBar.php' ?>
            </div>
            <!-- /.container -->
        </div>

        <!-- jQuery -->
        <script src="js/jquery.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.min.js"></script>
</body>

</html>
