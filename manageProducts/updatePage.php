<?php
    include '../homepage/dbConnection.php'; 
    include '../homepage/header.php';

    if (isset($_SESSION['userID'])) {
        $userID = $_SESSION["userID"];
    } else {
        header("Location:../loginRegister/login.php");
    }

    $queryAdminAccount = "SELECT * FROM `users` WHERE role = 'admin'";
    $postQueryAdmin = mysqli_query($connection, $queryAdminAccount);
    $adminIDs = array();

    while ($resultQueryAdmin = mysqli_fetch_assoc($postQueryAdmin)) {
        $checkMatchingID = $resultQueryAdmin['user_id'];
        array_push($adminIDs, $checkMatchingID);
    }

    if (in_array($userID, $adminIDs)) {
        null;
    } else {
        echo '<script>alert("You are not logged into an admin account!");
                    window.location = ("../loginRegister/login.php");
                    </script>';
    }

?>

<!DOCTYPE html>
<html lang="en" style = "background-color: white;">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Products</title>
    <link href = "../homepage/homepage.css" rel = "stylesheet" type = "text/css">
    <link href = "productsAndProfiles.css" rel ="stylesheet" type = "text/css">
    <link rel="stylesheet" href="../contactUs/inquiriesTable.css">
</head>
<body style = "background-color:white ;">
    <h1 class = "product_title">Update Products</h1>

    <div style = "background-color: white;" class="modify-inquiry">
        <form style ="background-color: white;" class="inquiry-box" action="#" method="post">
            <input type="text" class="inquiry-form" placeholder="Search Product" name="searchedProduct" required>
            <input type="submit" name="btnSubmit" class="inquiry-submit">
        </form>
        <a href="../manageProducts/updatePage.php"><button class="inquiry-reset">Reset</button></a>
    </div>

    <div class = "box-container">

        <?php
            
            if (isset($_POST['btnSubmit'])) {
                $searchedProductName = $_POST['searchedProduct'];
                $showProducts = "SELECT * FROM products WHERE `product_name` LIKE '%$searchedProductName%'";
                $result = mysqli_query($connection, $showProducts);
            } else {
                $showProducts = "SELECT * FROM products";
                $result = mysqli_query($connection, $showProducts);
            }
            
            if (mysqli_num_rows($result) > 0) {
                while ($gatherProducts = mysqli_fetch_assoc($result)) { ?>
            
            <form action = "updateProduct.php" method= "post" class = "item-box" enctype = "multipart/form-data">
                <div>
                    <img class ="product-img" src="../images/<?= $gatherProducts['product_image']; ?>" alt = "Picture of Product">
                    <div class = "product_name"><?= $gatherProducts['product_name']; ?></div>
                    <input type="hidden" name="productID" value="<?= $gatherProducts['product_id']; ?>">
                    <input type="hidden" name="productName" value="<?= $gatherProducts['product_name']; ?>">
                    <input type="hidden" name="productPrice" value="<?= $gatherProducts['product_price']; ?>">
                    <input type="hidden" name="productImage" value="<?= $gatherProducts['product_image']; ?>">
                    <div class = "price">RM<span><?= $gatherProducts['product_price']; ?></span>/per unit</div>
                    <div>Stock Remaining: <?= $gatherProducts['product_stock']; ?></div>
                    <button type="submit" value="Delete Product" class = "btn" name="updateProduct">Update</button>
                </div>
            </form>

            <?php }
            } else {
                echo "<h1 style = 'text-align: center;'>No Products To Update</h1>";        
            }   
        ?>
    </div>
</body>
</html>

<?php 
    mysqli_close($connection);
    include '../homepage/footer.php'; 
?>