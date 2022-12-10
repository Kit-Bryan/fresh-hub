<?php
require_once("../functionInc.php");
require_once("../dbInc.php");

//Check form submission
if (isset($_POST['loginBtn'])) {
    //Assign form inputs to variables 
    $firstName = trim($_POST['firstName']);
    $lastName = trim($_POST['lastName']);
    $email = $_POST['email'];
    $password = $_POST['password'];
} else {
    header("location: ../../loginRegister/login.php");
}


//Validations for signup inputs
if (emptyInput($firstName, $lastName, $email, $password) !== false) {
    header("location: ../../loginRegister/signup.php?error=emptyInputs");
    die();
}

if (invalidName($firstName, $lastName) !== false) {
    header("location: ../../loginRegister/signup.php?error=invalidName");
    die();
}

if (invalidEmail($email) !== false) {
    header("location: ../../loginRegister/signup.php?error=invalidEmail");
    die();
}

if (emailExist($conn, $email) !== false) {
    header("Location:../../loginRegister/signup.php?error=emailExist");
    die();
}

if (invalidPass($password) !== false) {
    header("location: ../../loginRegister/signup.php?error=invalidPassword");
    die();
}


$role = "customer";
appendUser($conn, $firstName, $lastName, $email, $password, $role);
header("Location:../../loginRegister/signup.php?error=noError");
die();

// Close db connection
mysqli_close($conn);
