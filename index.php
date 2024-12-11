<!DOCTYPE html>
<html lang="en">

<?php include 'includes/header.php';
session_start();


?>


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
                <!-- Blog Entries Column (Section-A) -->
                <div class="col-md-8 section-A" style="height: 500px; overflow-y: auto;">
                    <?php
                    $query = 'SELECT post_id, post_cat_id, post_title, post_author, post_date, post_image, post_content FROM test.post ORDER BY post_date DESC';

                    $select_post_data = mysqli_query($connection, $query);
                    while ($row = mysqli_fetch_assoc($select_post_data)) {
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

                        
                        <hr>

                    <?php
                    }
                    ?>
                    <ul class="pager">
                            <li class="previous">
                                <a href="#">&larr; Older</a>
                            </li>
                            <li class="next">
                                <a href="#">Newer &rarr;</a>
                            </li>
                        </ul>
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