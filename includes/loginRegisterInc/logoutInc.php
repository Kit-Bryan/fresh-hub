<?php  
session_start();
// Free session variables
session_unset();
// Remove session
session_destroy();

// Redirect user to homepage
header("Location:../../homepage/homepage.php");