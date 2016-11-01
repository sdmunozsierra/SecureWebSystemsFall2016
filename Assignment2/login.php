<?php
// login.php
/**
 * It works as the authentification page
 */
/*
 * Info:
 * Do not use the HTTP authentication headers described in our textbook.
 * When signing in, check the username and password against the registered users table.
 * Then use PHP sessions to keep the user logged in.
 * Make sure you destroy the session when the user signs out.
 */
require_once 'login.php'; // require login info

$connection = new mysqli ( $db_hostname, $db_username, $db_password, $db_database );
if ($connection->connect_error)
	die ( $connection->connect_error );
	
	// Print form for login
echo <<<_END
<form action="login.php" method="post">
	<fieldset>
		<legend>Login information:</legend>
			Username:<br>
			<input type="text" name="username"><br>
			Password:<br>
			<input type="text" name="password"><br>
			<input type="submit" value="Submit">
		</legend>
	</fieldset>
</form> 
_END;

// Debuggin purposes only -->
echo 'Entered Fields:<br>UN: ' . htmlspecialchars ( $_POST ["username"] ) . '!' .
		'PW: ' . htmlspecialchars ( $_POST ["password"] );

// If the if not working change "" to ''
if (isset ( $_POST ["username"] ) && isset ( $_POST ["password"] )) {
	// Sanitize the input
	$un_temp = mysql_entities_fix_string ( $connection, $_POST ["username"] );
	$pw_temp = mysql_entities_fix_string ( $connection, $_POST ["password"] );
}

$query = "SELECT * FROM users WHERE username='$un_temp'"; // create query
$result = $connection->query ( $query ); // save query

if (! $result) die ( $connection->error ); // kill if no username found

elseif ($result->num_rows) {
	$row = $result->fetch_array ( MYSQLI_NUM ); // save value in $row
	$result->close (); // destroy $result from $query
	$salt1 = "random"; // random salt
	$salt2 = $un_temp; // user salt
	$token = hash ( 'ripemd128', "$salt1$salt2$pw_temp" ); // random salt, user salt, pw
	                                                       
	// Validate password
	if ($token == $row [2]) { // my DB [0]FirstName [1]Uname [2]Pass
		/**
		 * Juice
		 */
		session_start (); // CREATE A SESSION!!!
		$_SESSION ['username'] = $un_temp;
		$_SESSION ['password'] = $pw_temp;
		$_SESSION ['forename'] = $row [0];
		echo "Hi $row[0],you are now logged in as '$row[1]'";
			die ( "<p><a href='continue.php'>Click here to continue</a></p>" );
		// elseif($token == admin password){TODO};//
	} else
		die ( "Invalid username/password combination" );
} else
	die ( "Invalid username/password combination" );

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
