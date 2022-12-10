<?php
require_once("../dbInc.php");
require_once("../functionInc.php");

// Assign variables
if (isset($_POST['loginBtn'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
} else {
    header("Location:../loginRegister/login.php");
}

// Validate email and password
$result = verifyLogin($conn, $email, $password) ;

if ($result === "badEmail") {
    header("Location:../../loginRegister/login.php?error=badEmail");
    die();
} else if ($result === "badPassword") {
    header("Location:../../loginRegister/login.php?error=badPassword");
    die();
} else if ($result === true) {
    header("Location:../../loginRegister/login.php?error=noError");
    die();
}

