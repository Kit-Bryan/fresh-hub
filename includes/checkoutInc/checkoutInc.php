<?php
require_once("../dbInc.php");
require_once("../functionInc.php");

if (!isset($_SESSION)) {
    session_start();
}
$userID = $_SESSION['userID'];


if (isset($_POST['checkoutBtn'])) {
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $contactNumber = $_POST['contact'];
    $address = $_POST['address'];
    $pMethod = $_POST['pMethod'];
} else {
    // Redirect to checkout page
    header("Location:../../checkout/checkout.php");
    die();
}


$cartItems = getCart($conn, $userID);

// Get Total products, Quantity, Total price
$totalProducts = [];
$totalPrice = 0;

foreach ($cartItems as $cartItem) {

    $totalProducts[] = $cartItem['product_name']  . "(" . $cartItem['cart_item_quantity'] . ")";
    $totalPrice += $cartItem['product_price'];

    // Update stock quantity
    $productID = $cartItem['product_id'];
    $selectProductQuery = "SELECT * FROM `products` WHERE `product_id` = $productID";
    $results = mysqli_query($conn, $selectProductQuery);
    $product = mysqli_fetch_assoc($results);
    $remainingProductStock = $product['product_stock'] - $cartItem['cart_item_quantity'];
    $updateQuantityQuery = "UPDATE products SET `product_stock` = '$remainingProductStock' WHERE `product_id` = '$productID'";
    mysqli_query($conn, $updateQuantityQuery);
}
$totalProducts = implode(", ", $totalProducts);


appendOrder($conn, $fullName, $contactNumber, $email, $address, $totalProducts, $totalPrice, $pMethod);
deleteCartItems($conn, $userID);

// Redirect thank you page
header("Location:../../checkout/thankYou.php");
die();