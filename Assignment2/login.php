<?php //login webpage
/**
 * Created by PhpStorm.
 * User: xerg
 * Date: 10/25/2016
 * Time: 7:24 PM
 */

// Start the session
session_start();
?>
<!DOCTYPE html>
<html>
<title>"Login2"</title>
<body>

<?php
// Set session variables
$_SESSION["favcolor"] = "green";
$_SESSION["favanimal"] = "cat";

echo "Session variables are set.";
?>

// create a form with fields username and password
<form action="login2.php" method="post">
    Username: <input type="text" name="username"><br>
    Password: <input type="text" name="password"><br>
    <input type="submit">
</form>
<?php
//Displays the username and password
if (isset($_SESSION['username'])) $username = $_COOKIE['username']; //Save username
if (isset($_SESSION['password'])) $password = $_COOKIE['password']; //Save password

echo "Username (From variable) .$username";
echo "Password (From variable).$password";



?>


<?php
// remove all session variables
session_unset();
// destroy the session
session_destroy();
?>

</body>
</html>

/*
<?php //authenticate2.php
require_once 'login.php'; //database information
//Create a new mysqli connection
$conn = new mysqli($hn, $un, $pw, $db);
if($conn->connect_error) die ($conn->connect_error); //kill connection if error

if (isset($_SERVER['PHP_AUTH_USER']) &&
    isset($_SERVER['PHP_AUTH_PW']))
{
    $un_temp = mysql_entities_fix_string($conn, $_SERVER['PHP_AUTH_USER']);
    $pw_temp = mysql_entities_fix_string($conn, $_SERVER['PHP_AUTH_PW']);
    //If they both exist, they represent the username and password entered by a user into an authentication prompt.

    $query = "SELECT * FROM users WHERE username='$un_temp'";
    $result = $connection->query($query);
    if (!$result) die($connection->error);
    elseif ($result->num_rows)
    {
        $row = $result->fetch_array(MYSQLI_NUM);
        $result->close();
        $salt1 = "qm&h*";
        $token = hash('ripemd128', "$salt1$pw_temp$salt2");
        if ($token == $row[3])
        {
            session_start();
            $_SESSION['username'] = $un_temp;
            $_SESSION['password'] = $pw_temp;
            $_SESSION['forename'] = $row[0];
            $_SESSION['surname'] = $row[1];
            echo "$row[0] $row[1] : Hi $row[0],
you are now logged in as '$row[2]'";
            die ("<p><a href=continue.php>Click here to continue</a></p>");
        }
        else die("Invalid username/password combination");
    }
    else die("Invalid username/password combination");
}
else
{
    header('WWW-Authenticate: Basic realm="Restricted Section"');
    header('HTTP/1.0 401 Unauthorized');
    die ("Please enter your username and password");
}
$connection->close();
function mysql_entities_fix_string($connection, $string)
{
    return htmlentities(mysql_fix_string($connection, $string));
}
function mysql_fix_string($connection, $string)
{
    if (get_magic_quotes_gpc()) $string = stripslashes($string);
    return $connection->real_escape_string($string);
}
?>
