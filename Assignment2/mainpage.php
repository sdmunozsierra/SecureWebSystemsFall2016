<?php //mainpage.php
session_start();

echo "<!DOCTYPE html>\n<html><head><title>Main page</title>";


if (isset($_SESSION['username']) && $_SESSION['username'] == 'admin'){
    //Logged in as the admin
//    echo "You are logged in as the administrator what you would like to do?";
//    echo "<br><p style='color: crimson'>Important Notice: If you refresh the page you will be logged out!</p>";
//    echo "<button type='submit' id="getmeout">Log out!</button>";
//    echo <<<_END
//<script type=\"text/javascript\">
//var e = document.getElementById('testForm'); e.action='test.php'; e.submit();
//</script>
//
//
//_END;
    echo <<<_END
    <body><h1>Main Page</h1>
    <p> Your current status is: <b style="color:red;">Administrator</b><br>
    Available links:<br>
    <a href='mainpage.php'>main page</a> (This page)<br>
    <a href='admin.php'>admin page</a><br>
    <a href='user.php'>user page</a><br>
    <a href='register.php'>register page</a><br>

    <form action="logout.php">
    <input type="submit" value="Log me out" /> <!--Value: Name on button-->
    </form>




_END;

    echo "</body></html>"; //end the page for admin
}

elseif(isset($_SESSION['username'])){
    //Logged in as a user
    echo <<<_END
    <body><h1>Main Page</h1>
    <p> Your current status is: <b style="color:red;">User</b><br>
    Available links:<br>
    <a href='mainpage.php'>main page</a> (This page)<br>
    <a href='user.php'>user page</a><br>
    <a href='register.php'>register page</a><br>

    <form action="logout.php">
    <input type="submit" value="Log me out" /> <!--Value: Name on button-->
    </form>
_END;
    echo "</body></html>"; //end the page for admin
}

else{
    //Show page as a visitor
    //echo "<p>You are a visitor, <a href=login.php>please sign in<a>";
    echo <<<_END

    <body><h1>Main Page</h1>
    <p> Your current status is: <b style="color:red;">Visitor</b><br>
    Available links:<br>
    <a href='mainpage.php'>main page</a> (This page)<br>
    <a href='register.php'>register page</a><br>
    <a href='login.php'>log in page</a><br>

    <!--Log in button -->
    <form action="login.php">
    <input type="submit" value="Log me in" /> <!--Value: Name on button-->
    </form>
_END;

    echo "</body></html>"; //end the page for admin
}


//Functions
function destroy_session_and_data(){
    $_SESSION = array();
    setcookie(session_name(), '', time() - 2592000, '/');
    session_destroy();
}

