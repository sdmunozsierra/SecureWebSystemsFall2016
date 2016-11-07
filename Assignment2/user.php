<?php //user.php
session_start();

echo "<!DOCTYPE html>\n<html><head><title>Admin Page</title>";
if (isset($_SESSION['username'])){
    //user logged in
    echo "<body><h1>User Page</h1><p>User stuff...</p>";
    echo <<<_END
    <a href='mainpage.php'>main page</a><br><br>

    <form action="logout.php">
    <input type="submit" value="Log me out" /> <!--Value: Name on button-->
    </form></body></html>
_END;
}

else{
    //not authorized
    echo "<body>You have not permission to be here...";
    echo "<br>Go to <a href='mainpage.php'>mainpage</a></br>or</or><br>Go to <a href='login.php'>login</a>.";
    echo "</body></html>";
}
