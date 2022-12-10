<?php
require_once("../dbInc.php");
require_once("../functionInc.php");


if (isset($_POST['changeBtn'])) {
    $email = $_POST['email'];
    $newPass = $_POST['password'];
} else {
    header("Location:../../loginRegister/login.php");
}


// Check password length
if (invalidPass($newPass) === true) {
    $badpassword = true;
} else {
    $badpassword = false;
}

// Wrong password
if ($badpassword === true) {
    header("Location:../../loginRegister/forgotPass.php?error=badPassword");
    die();
// Check email exists
} else if (changePass($conn, $email, $newPass) === false) { 
    header("Location:../../loginRegister/forgotPass.php?error=badEmail");
    die();
} else {
    header("Location:../../loginRegister/forgotPass.php?error=noError");
    die();
}
