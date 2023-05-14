<?php
// End session
session_start();
session_unset();
session_destroy();

// Deleting the username cookie
setcookie("username_Cookie",$username,  time() + (86400 * 30), "/");

// Takes user back to the login page
header("location:./login.php");
exit();
?>