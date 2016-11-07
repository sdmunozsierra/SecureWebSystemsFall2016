<?php //continue.php
session_start();
if (isset($_SESSION['username'])){
    $username = $_SESSION['username'];
    $password = $_SESSION['password'];
    $forename = $_SESSION['forename'];
    //destroy_session_and_data();
    echo "Welcome back $forename.<br>
Your full name is $forename.<br>
Your username is '$username'
and your password is '$password'.";

    echo "<br>Go to <a href='mainpage.php'>mainpage</a>.";
}
else echo "Please <a href='login.php'>click here</a> to log in.";

?>
