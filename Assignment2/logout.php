<?php //logout.php

echo "<br><p style='color: crimson'>Important Notice: You will be logged out!</p>";
session_start();
session_destroy();
header('Location: mainpage.php');
exit;
