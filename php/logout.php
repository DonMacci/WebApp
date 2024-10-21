<?php 
session_start(); // Start the session

//Destroy Session
session_unset();
session_destroy();

echo "You have been logged out!";
?>
<a href="login.php">Login Again</a>