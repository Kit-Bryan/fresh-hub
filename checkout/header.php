<?php
include("../includes/dbInc.php");

if (!isset($_SESSION)) {
    session_start();
}

if (isset($_SESSION['userID'])) {
    $userID = $_SESSION["userID"];
    $userRole = $_SESSION["userRole"];
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>Fresh Hub</title> -->
    <!-- title logo -->
    <link rel="icon" href="../homepage/images/logo_plain_smol.png" type="logo/png">
    <!-- homepage css -->
    <link rel="stylesheet" href="headerFooter.css">
    <!-- bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <!-- google fonts API -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Calistoga&family=Didact+Gothic&display=swap" rel="stylesheet">
</head>

<body>

    <div class="header">
        <div id="container">
            <div class="navbar">
                <div class="logo">
                    <a href="../homepage/homepage.php"><img src="../images/logo_white_smol.png" alt="logo" width="165px" height="75px"></a>
                </div>
                <nav>
                    <ul>
                        <li><a href="../homepage/homepage.php">Home</a></li>
                        <li><a href="../homepage/homepage.php#about-us">About Us</a></li>
                        <li><a href="../viewProducts/productPage.php">Products</a></li>
                        <li><a href="../contactUs/contactpage.php">Contact Us</a></li>
                        <!-- admin only functions  !!!!!! -->
                        <?php if (isset($_SESSION['userRole'])) {
                            if ($userRole == "admin") {
                                echo "<li><a href='../manageProducts/adminPanelSelection.php'>Admin Panel</a></li>";
                                echo "<li><a href='../contactUs/viewInquiries.php'>View Inquiries</a></li>";
                            }
                        }
                        ?>
                        <!-- login/logout detection -->
                        <?php if (isset($_SESSION['userID'])) {
                            $userID = $_SESSION["userID"];
                            echo "<li><a href='../viewOrderHistory/orderHistory.php'>Order History</a></li>";
                            echo "<li><a href='../includes/loginRegisterInc/logoutInc.php'> Log out </a></li>";
                        } else {
                            echo "<li><a href='../loginRegister/login.php'> Login </a></li>";
                        }
                        ?>
                        <!-- icons -->
                        <li>
                            <a href="../profilePage/editProfile.php"><i class="bi-person-circle" style="font-size: 30px; color: #FFF;"></i></a>
                        </li>
                        <li>
                            <a href="../shoppingCart/cart.php"><i class="bi-bag" style="font-size: 30px; color: #FFF;"></i></a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</body>

</html>