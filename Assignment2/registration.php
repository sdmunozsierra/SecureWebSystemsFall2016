<?php //registration.php
//Start the session
session_start();
/**
 * For salting, you should use 2 strings: a constant string of random characters, and the username,
 * so you will store in the table the hash function applied to the concatenation of 3 strings: a constant string of random characters,
 * the userid, and the password. In this way, one would need to have access to both the database and the php program to mount a password cracking attack,
 * and the username used as an additional salt will slow down the brute force attack.
 * Usernames should be unique.
 */
require_once 'login.php'; //require login.php
//Make connection
$conn = new mysqli($hn, $un, $pw, $db);
if($conn->connect_error) die ($conn->connect_error); //kill connection if error

if (isset($_SERVER['PHP_AUTH_USER']) &&
    isset($_SERVER['PHP_AUTH_PW'])) {
    $un_temp = mysql_entities_fix_string($conn, $_SERVER['PHP_AUTH_USER']);
    $pw_temp = mysql_entities_fix_string($conn, $_SERVER['PHP_AUTH_PW']);

    $query = "SELECT * FROM users WHERE username='$un_temp'"; //check the user in database
    $result = $conn->query($query);
    if (!$result) //instead of die, make subquery register
    {
        add_user($conn, $username, $token);
    }
    else{
        echo "something";
    }
}
/**
 * TODO
 * Check that the user is not on the database
 * Add Salt 1 and 2.
 * Add hashing
 * Create the user on the database
 *
 * Links to:
 *
 */
/** Forms */
$form1 = <<<_FORM1
<br/>
<b>Username: &emsp;&emsp;&emsp;&emsp;&ensp; Password:</b>
<form action ="registration.php" method="post">
<input type="text" placeholder="Enter Username" name="username" value="$un_temp">
<input type="text" placeholder="Enter Password" name="password" value="$pw_temp">
<input type="submit" value="submit"></form>
_FORM1;

/** Strings */
//Start
$head = <<<_HEADER
<html>
<title>Registration</title>
<body>
_HEADER;
//End
$enddoc = <<<_HEADEREND
</body>
</html>
_HEADEREND;

/** Page starts */
echo $head; //Display header html
echo "You are on Registration page<br>";
echo $form1;

echo $enddoc; //end of document

/** Functions */
function add_user($conn,$un, $pw)
{
    $salt1 = "random";
    $salt2 = $un;
    $pretoken = "$salt1$salt2$pw";
    $token = hash('ripemd128', "$pretoken");


    $query = "INSERT INTO users VALUES('$un','$token')";
    $result = $conn->query($query);
    if (!$result) die($conn->error);
    echo "<b>Added Username: </b>".$un."<br><b>Salt1:</b> ".$salt1.
        "<br><b>Salt2</b>".$salt2."<br><b>Function before hash:</b>".$pretoken.
        "<br><b>Hash: </b>".$token;
} //end add_user

function mysql_entities_fix_string($connection, $string)
{
    return htmlentities(mysql_fix_string($connection, $string));
}
function mysql_fix_string($connection, $string)
{
    if (get_magic_quotes_gpc()) $string = stripslashes($string);
    return $connection->real_escape_string($string);
}


