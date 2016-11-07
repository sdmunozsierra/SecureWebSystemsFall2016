<?php //admin.php
session_start();


echo "<!DOCTYPE html>\n<html><head><title>Admin Page</title>";
if (isset($_SESSION['username']) && $_SESSION['username'] == 'admin'){
    //admin logged in
    echo "<body><h1>Administrator Page</h1><p>Admin stuff...</p>";
    echo <<<_END
    <form action="logout.php">
    <input type="submit" value="Log me out" /> <!--Value: Name on button-->
    </form>
    <a href='mainpage.php'>main page</a><br>
    </body></html>

_END;
}

else{
    //not authorized
    echo "<body>You have not permission to be here...";
    echo "<br>Go to <a href='mainpage.php'>mainpage</a></br>or</or><br>Go to <a href='login.php'>login</a>.";
    echo "</body></html>";
}
