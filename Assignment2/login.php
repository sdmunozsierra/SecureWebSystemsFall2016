<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html>
<body>

<?php
// Set session variables
$_SESSION["favcolor"] = "green";
$_SESSION["favanimal"] = "cat";
echo "Session variables are set.";
?>

// create a form with fields username and password
<form action="login.php" method="post">
Username: <input type="text" name="username"><br>
Password: <input type="text" name="password"><br>
<input type="submit">
</form>
  
  
  
<?php
// remove all session variables
session_unset();

// destroy the session
session_destroy();
?>

</body>
</html> 
