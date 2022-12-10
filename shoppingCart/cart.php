<?php
include("../includes/dbInc.php");

if (!isset($_SESSION)) {
    session_start();
}


if (isset($_SESSION['userID'])) {
    $userID = $_SESSION["userID"];
} else {
    header("Location:../loginRegister/login.php");
}

if (isset($_POST['update_quantity_btn'])) {
    $updateValue = $_POST['update_quantity'];
    $updateID = $_POST['update_product_id'];

    $update_quantity_query = "UPDATE `cart_items` SET `cart_item_quantity` = ? WHERE `product_id` = ? and `user_id` = ?";
    $stmt = mysqli_prepare($conn, $update_quantity_query);
    mysqli_stmt_bind_param($stmt, "iii", $updateValue, $updateID, $userID);
    mysqli_stmt_execute($stmt);
}

if (isset($_GET['remove'])) {
    $removeID = $_GET['remove'];
    $remove_query = "DELETE FROM cart_items WHERE `product_id` = ? and `user_id` = ?";
    $stmt = mysqli_prepare($conn, $remove_query);
    mysqli_stmt_bind_param($stmt, "ii", $removeID, $userID);
    mysqli_stmt_execute($stmt);
}

if (isset($_GET['remove_all'])) {
    $remove_all_query = "DELETE FROM cart_items WHERE `user_id` = ?";
    $stmt = mysqli_prepare($conn, $remove_all_query);
    mysqli_stmt_bind_param($stmt, "i", $userID);
    mysqli_stmt_execute($stmt);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <!-- Icon -->
    <link rel="icon" href="../images/transparent_official_logo_plain.png" type="logo/png">
    <!-- External icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Calistoga&family=Didact+Gothic&display=swap" rel="stylesheet">
    <!-- Link to style sheet -->
    <link rel="stylesheet" href="cart.css">
</head>

<body>
    <?php
    include_once("header.php")
    ?>
    <div class="container">
        <section class="shopping-cart">
            <h1 class="heading">Shopping cart</h1>
            <table>
                <thead>
                    <th>Image</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total price</th>
                    <th></th>
                </thead>
                <tbody>
                    <?php
                    $select_cart_query = "SELECT * FROM cart_items WHERE `user_id` = '$userID'";
                    $grand_total = 0;
                    $results = mysqli_query($conn, $select_cart_query);
                    $products = mysqli_fetch_all($results, MYSQLI_ASSOC);
                    if ($products) {
                        foreach ($products as $product) {

                    ?>
                            <tr class="products">
                                <td><img src="../images/<?php echo $product['product_image']; ?>" alt="<?= $product['product_name']; ?> image"></td>
                                <td><?php echo $product['product_name']; ?></td>
                                <td>RM <?php echo number_format($product['product_price'], 2, '.', ''); ?></td>
                                <td>
                                    <!-- Send form to same page -->
                                    <form action="" method="post">
                                        <input type="hidden" name="update_product_id" value="<?php echo $product['product_id']; ?>">
                                        <input type="number" name="update_quantity" min="1" value="<?php echo $product['cart_item_quantity']; ?>">
                                        <input type="submit" value="Update" name="update_quantity_btn">
                                    </form>
                                </td>
                                <td>RM <?php echo $sub_total = number_format($product['product_price'] * $product['cart_item_quantity'], 2, '.', ''); ?></td>
                                <td><a href="cart.php?remove=<?php echo $product['product_id']; ?>" onclick="return confirm('Remove item from cart?')" class="delete-btn"> <i class="fas fa-trash"></i> Remove</a></td>
                            </tr>

                    <?php
                            $grand_total += $sub_total;
                            $grand_total = number_format($grand_total, 2, ".", ",");
                        }
                    }
                    ?>
                    <tr class="table-bottom">
                        <td><a href="../viewProducts/productPage.php" class="continue-btn">Continue shopping</a></td>
                        <td colspan="3">Grand total</td>
                        <td>RM <?php echo $grand_total;  ?></td>
                        <td><a href="cart.php?remove_all" onclick="return confirm('Are you sure you want to remove all?');" class="delete-btn"> <i class="fas fa-trash"></i> Remove all</a></td>
                    </tr>
                </tbody>
            </table>
            <div class="checkout-btn">
                <a href="../checkout/checkout.php" class="<?php if ($grand_total > 1) {
                                                                echo '';
                                                            } else {
                                                                echo 'disabled';
                                                            } ?>">Proceed to Checkout</a>
            </div>

        </section>
    </div>
    <?php
    mysqli_close($conn);
    // Footer
    include_once("footer.php")
    ?>
</body>

</html>