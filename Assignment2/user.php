<?php //user.php
/** Will have a small count down timer based on JavaScript */
echo <<<_HEAD
<!DOCTORTYPE html>
<head>
<title>User Page</title>
</head>
<body>
_HEAD

echo "<h1>Countdown until Christmas</h1><br>";
echo '<script type="text/javascript" src="countdown.js"></script>';

?>

//ADD THE FOLLOWING
<?php // continue.php
  session_start();
  if (isset($_SESSION['username']))
  {
    $username = $_SESSION['username'];
    $password = $_SESSION['password'];
    $forename = $_SESSION['forename'];
    $surname  = $_SESSION['surname'];
    echo "Welcome back $forename.<br>
          Your full name is $forename $surname.<br>
          Your username is '$username'
          and your password is '$password'.";
  }
  else echo "Please <a href='authenticate2.php'>cli
ck here</a> to log 
in.";
?>
