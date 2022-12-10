<?php
require_once("../includes/dbInc.php");
require_once("../includes/functionInc.php");

if (!isset($_SESSION)) {
    session_start();
}

// Check if user is logged in
if (isset($_SESSION['userID'])) {
    $userID = $_SESSION['userID'];
} else {
    header("Location:../homepage/homepage.php");
    die();
}

// If user no cart item, redirect to homepage
$sql = "SELECT * FROM `cart_items` WHERE `user_id` = '$userID'";
$results = mysqli_query($conn, $sql);
if (!mysqli_fetch_all($results, MYSQLI_ASSOC)) {
    header("Location:../homepage/homepage.php");
}


if ($row = getUser($conn, $userID)) {
    $firstName = $row['first_name'];
    $lastName = $row['last_name'];
    $email = $row['email'];

    //If variable no value, assign empty string
    if (!$contactNumber = $row['contact_number']) {
        $contactNumber = "";
    }
    $address = $row['address'] ? $row['address'] : "";
} else {
    // No such user, redirect to login
    header("Location:../loginRegister/login.php");
    die();
}


if (isset($_POST['checkoutBtn'])) {
    echo '<pre>';
    var_dump($_POST);
    echo '</pre>';
}


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Icon -->
    <link rel="icon" href="../images/transparent_official_logo_plain.png" type="logo/png">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Calistoga&family=Didact+Gothic&display=swap" rel="stylesheet">
    <!-- External icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Link to style sheet -->
    <link rel="stylesheet" href="checkout.css">
    <title>Checkout</title>
</head>

<body>
    <!-- Nav bar -->
    <?php
    include_once("header.php");
    ?>
    <div class="checkout">
        <div class="checkout-form">
            <h1>Checkout Form</h1>
            <form action="../includes/checkoutInc/checkoutInc.php" method="POST">
                <p>
                    <label for="name"><i class="fa-regular fa-user"></i> Full Name</label>
                    <input id="name" type="text" name="fullName" placeholder="Willson Smith" value="<?= "{$firstName} {$lastName}" ?>" readonly>
                </p>
                <p>
                    <label for="email"><i class="fa-regular fa-envelope"></i> Email</label>
                    <input id="email" type="email" name="email" placeholder="abc@example.com" value="<?= "{$email}"; ?>" readonly>
                </p>
                <p>
                    <label for="contactNumber"><i class="fa-regular fa-address-card"></i> Contact Number</label>
                    <input id="name" type="text" name="contact" value="<?= "{$contactNumber}" ?>" placeholder="Eg: 012-3456789" required>
                </p>
                <p>
                    <label for="address"><i class="fa-regular fa-address-book"></i> Address </label>
                    <input id="name" type="text" name="address" value="<?= "{$address}"; ?>" placeholder="Eg: Jalan Teknologi 5, Taman Teknologi Malaysia, 57000 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur" required>
                </p>
                <div class="payment-method">
                    <p>
                        Payment Method <i class="fa-solid fa-money-bill-1"></i>
                    </p>
                    <label>
                        <input type="radio" name="pMethod" value="COD" class="radio-button" checked required>
                        Cash on delivery
                    </label>
                    <label>
                        <input type="radio" name="pMethod" value="CreditCard" class="radio-button">
                        Credit Card
                    </label>
                    <label>
                        <input type="radio" name="pMethod" value="GrabPay" class="radio-button">
                        GrabPay
                    </label>
                </div>
                <button type="submit" name="checkoutBtn">Checkout</button>
            </form>


        </div>
        <div class="order-summary">
            <h3>Order Summary</h3>
            <table>
                <thead>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </thead>
                <tbody>
                    <?php
                    $select_cart_query = "SELECT * FROM cart_items WHERE `user_id` = '$userID'";
                    $grandTotal = 0;
                    $results = mysqli_query($conn, $select_cart_query);
                    $products = mysqli_fetch_all($results, MYSQLI_ASSOC);
                    if ($products) {
                        foreach ($products as $product) {
                    ?>
                            <tr class="products">
                                <td class="product-name"><?php echo $product['product_name']; ?></td>
                                <td><?php echo $product['cart_item_quantity'] ?></td>
                                <td class="product-price">RM <?php echo $subTotal = number_format($product['product_price'] * $product['cart_item_quantity'], 2, '.', ''); ?></td>
                            </tr>
                    <?php
                            $grandTotal += $subTotal;
                            $grandTotal = number_format($grandTotal, 2, ".", ",");
                        }
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr class="table-bottom">
                        <td colspan="2">Grand total</td>
                        <td>RM <?php echo $grandTotal;  ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <!-- Footer -->
    <?php
    mysqli_close($conn);
    include_once("footer.php");
    ?>
</body>

</html>