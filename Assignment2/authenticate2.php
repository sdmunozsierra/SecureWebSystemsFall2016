<?php // authenticate2.php
require_once 'dbLogin.php';
$connection = new mysqli($hn, $un, $pw, $db);
if ($connection->connect_error)
    die ( $connection->connect_error );
//if (isset ( $_SERVER ['PHP_AUTH_USER'] ) && isset ( $_SERVER ['PHP_AUTH_PW'] )) {
//    $un_temp = mysql_entities_fix_string ( $connection, $_SERVER ['PHP_AUTH_USER'] );
//    $pw_temp = mysql_entities_fix_string ( $connection, $_SERVER ['PHP_AUTH_PW'] );

//POST FROM LOGIN.PHP
if(isset($_POST['Susername']) && isset($_POST['Spassword'])){
    $un_temp = $_POST['Susername'];
    $pw_temp = $_POST['Spassword'];


    $query = "SELECT * FROM users WHERE username='$un_temp'"; //create query
    $result = $connection->query ( $query ); //save query

    if (! $result) //no query?
        die ( $connection->error ); //kill
    elseif ($result->num_rows) { //else
        $row = $result->fetch_array ( MYSQLI_NUM );
        $result->close (); //destroy query
        $salt1 = "r4nd0m";
        $salt2 = "$un_temp";
        $token = hash ( 'ripemd128', "$salt1$salt2$pw_temp" ); //salt and hash
        if ($token == $row [2]) { //password is on row2
            //IMPORTANT
            session_start (); //CREATE A SESSION!!!
            //IMPORTANT
            $_SESSION ['username'] = $un_temp;  //row1
            $_SESSION ['password'] = $pw_temp;  //row2
            $_SESSION ['forename'] = $row [0];  //row0
            echo " Hello $row[0], you are now logged in as '$row[1]'";
            die ( "<p><a href='continue.php'>Click here to continue</a></p>" ); //go to continue.php (debugging purposes)
        } else
            die ( "Invalid username/password combination" );
    } else
        die ( "Invalid username/password combination" );
}
else {
    die ( "<p><a href='login.php'>Click here to login</a></p>" );
}
$connection->close (); //kill connection
//functions
function mysql_entities_fix_string($connection, $string) {
    return htmlentities ( mysql_fix_string ( $connection, $string ) );
}
function mysql_fix_string($connection, $string) {
    if (get_magic_quotes_gpc ())
        $string = stripslashes ( $string );
    return $connection->real_escape_string ( $string );
}
