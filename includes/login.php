<?php
include 'db.php';
session_start();

$_SESSION['logged_in'] = false;

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Sanitize input to prevent SQL injection (though better with prepared statements)
    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);

    // Query to get the user data
    $query = "SELECT * FROM test.login WHERE username = '{$username}'";
    $select_login_query = mysqli_query($connection, $query);

    if (!$select_login_query) {
        die('Query failed: ' . mysqli_error($connection));
    }

    // Initialize variables to check if the user exists
    $db_username = "";
    $db_password = "";

    // Fetch the user record from the database
    $row = mysqli_fetch_assoc($select_login_query);
    if ($row) {
        $db_username = $row['username'];
        $db_password = $row['password'];
        $check_password = password_verify($password, $db_password);
        // Check if the password matches
        if ($username == $db_username && $check_password) {
            $_SESSION['username'] = $db_username;
            $_SESSION['logged_in'] = true;
            header('Location: ../index.php');
            exit();
        } 
    } else {
        // No matching user was found
        $message = 'Wrong credentials';
    }
}else{
    $message = '';
}
?>
