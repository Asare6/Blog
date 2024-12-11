<?php include 'db.php' ?>

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

                <li><a href='#'>About</a></li>;
                <li><a href='#'>Service</a></li>;
                <li><a href='#'>Contact</a></li>;
                <?php

                if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
                    echo "<li><a onClick=\"javascript:return confirm('Are you sure you want to log out?');\" href='includes/logOut.php'>Log Out</a></li>";

                } else {
                    echo "<li><a href='signup.php'>Sign Up</a></li>";
                }
                ?>





            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>

<script></script>