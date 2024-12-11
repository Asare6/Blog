<?php

?>
<div class="col-md-4">

    <!-- Blog Search Well - Visible only if user is not logged in -->
    <div class="well">
        <h4>Blog Search</h4>
        <form action="search.php" method="post">
            <div class="input-group">
                <input name="search" type="text" class="form-control">
                <span class="input-group-btn">
                    <button name="submit" class="btn btn-default" type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div>
        </form>
    </div>

    <!-- Blog Categories Well - Always displayed -->
    <?php if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true): ?>
        <div class="well">
            <h4>Login</h4>
            <form action="includes/login.php" method="post">
                <div class="mb-3">
                    <input name="username" type="text" class="form-control" id="username" placeholder="Username" required><br>
                </div>
                <div class="mb-3">
                    <input name="password" type="password" class="form-control" id="password" placeholder="Password" required><br>
                    <button name="login" type="submit" class="btn btn-primary">Login</button>
                </div>
            </form>
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
        <div>
            <a href='post.php'><button class="btn btn-primary">Add New Post +</button></a>
        </div><br>
    <?php endif; ?>



    <!-- Side Widget Well - Always displayed -->
    <div class="well">
        <h4>Side Widget Well</h4>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
    </div>

</div>