<?php //authenticate.php
require_once 'login.php';
$connection = new mysqli ( $hn, $un, $pw, $db );
if ($connection->connect_error)
	die ( $connection->connect_error );

if (isset ( $_SERVER ['PHP_AUTH_USER'] ) && isset ( $_SERVER ['PHP_AUTH_PW'] )) {
	$un_temp = mysql_entities_fix_string ( $connection, $_SERVER ['PHP_AUTH_USER'] );
	$pw_temp = mysql_entities_fix_string ( $connection, $_SERVER ['PHP_AUTH_PW'] );
	
	$query = "SELECT * FROM users WHERE username='$un_temp'"; //make a query with the temp 
	$result = $connection->query ( $query ); //make query
	if (! $result) //no result
		die ( $connection->error );//kill conection
	elseif ($result->num_rows) { //fetch the array
		$row = $result->fetch_array ( MYSQLI_NUM ); //MYSQLI_NUM
		$result->close (); //close result
		$salt1 = "qm&h*"; //first salt
		$salt2 = "pg!@"; //second salt
		$token = hash ( 'ripemd128', "$salt1$pw_temp$salt2" ); //use ripemd128
		if ($token == $row [3]) //correct hash
			echo "$row[0] $row[1] : Hi $row[0], you are now logged in as '$row[2]'";
		else
			die ( "Invalid username/password combination" ); //do not give too much info
	} else
		die ( "Invalid username/password combination" ); //not much info
} else {
	header ( 'WWW-Authenticate: Basic realm="Restricted Section"' ); //restricted section
	header ( 'HTTP/1.0 401 Unauthorized' );	//unauthorized
	die ( "Please enter your username and password" ); //prompt again
}
$connection->close (); //end connection

//Functions
function mysql_entities_fix_string($connection, $string) {
	return htmlentities ( mysql_fix_string ( $connection, $string ) );
}
function mysql_fix_string($connection, $string) {
	if (get_magic_quotes_gpc ())
		$string = stripslashes ( $string );
	return $connection->real_escape_string ( $string );
}
?>
