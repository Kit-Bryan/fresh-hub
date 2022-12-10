<?php

function emptyInput($firstName, $lastName, $email, $password)
{
    if (empty($firstName) || empty($lastName) || empty($email) || empty($password)) {
        return true;
    } else {
        return false;
    }
}

// Check for number in string
function numPresent($string)
{
    for ($i = 0; $i < strlen($string); $i++) {
        if (ctype_digit($string[$i])) {
            return true;
        }
    }
    return false;
}


// Check length or has num
function invalidName($firstName, $lastName)
{
    
    if (strlen($firstName) > 25 or strlen($firstName) < 3) {
        return true;
    } else if (strlen($lastName) > 25 or strlen($lastName) < 3) {
        return true;
    } else if (numPresent($firstName)) {
        return true;
    } else if (numPresent($lastName)) {
        return true;
    } else {
        return false;
    }
}

function invalidEmail($email)
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}

function emailExist($conn, $email)
{
    $sql = "SELECT * FROM `users` WHERE `email` = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($result)) {
        return $row;
    } else {
        return false;
    }
}

function invalidPass($password)
{
    if (strlen($password) < 8) {
        return true;
    } else {
        return false;
    }
}

function appendUser($conn, $firstName, $lastName, $email, $password, $role)
{
    $hashPass = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO `users` (`first_name`, `last_name`, `email`, `password`, `role`) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssss", $firstName, $lastName, $email, $hashPass, $role);
    mysqli_stmt_execute($stmt);

    // Retrieve user ID
    $sql = "SELECT * FROM `users` WHERE email = ? ";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    // Assign session user id
    session_start();
    $_SESSION['userID'] = $row['user_id'];
    $_SESSION['userRole'] = $row['role'];
    $_SESSION['userEmail'] = $row['email'];
}

function verifyLogin($conn, $email, $password)
{
    if ($row = emailExist($conn, $email)) {
        // Verify user input password and db password 
        $verify = password_verify($password, $row['password']);
        if ($verify) {
            // Assign session variables
            session_start();
            $_SESSION['userID'] = $row['user_id'];
            $_SESSION['userRole'] = $row['role'];
            $_SESSION['userEmail'] = $row['email'];
            return true;
        } else {
            return "badPassword";
        }
    } else {
        return "badEmail";
    }
}

function changePass($conn, $email, $newPass)
{
    if ($row = emailExist($conn, $email)) {
        $hashPass = password_hash($newPass, PASSWORD_DEFAULT);
        $id = $row['user_id'];
        $sql = "UPDATE `users` SET `password` = ? WHERE `user_id` = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $hashPass, $id);
        mysqli_stmt_execute($stmt);
    } else {
        return false;
    }
}

// Checkout form starts here
// Get user's cart
function getCart($conn, $userID)
{
    $query = "SELECT * FROM `cart_items` WHERE `user_id` = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $userID);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $rows;
}



function appendOrder($conn, $fullName, $contactNumber, $email, $address, $totalProducts, $totalPrice, $pMethod)
{
    $query = "INSERT INTO `orders` (`full_name`, `contact_number`, `email`, `address`, `total_products`, `total_price`, `payment_mode`) VALUES (?,?,?,?,?,?,?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "sssssss", $fullName, $contactNumber, $email, $address, $totalProducts, $totalPrice, $pMethod);
    mysqli_stmt_execute($stmt);
}

function deleteCartItems($conn, $userID)
{
    $query = "DELETE FROM `cart_items` WHERE `user_id` = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $userID);
    mysqli_stmt_execute($stmt);
}



// Get user's details
function getUser($conn, $userID)
{
    $sql = "SELECT * FROM `users` WHERE `user_id` = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $userID);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($result)) {
        return $row;
    } else {
        return false;
    }
}
