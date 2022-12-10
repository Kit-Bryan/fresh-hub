<?php
    include '../homepage/dbConnection.php'; 
    include '../homepage/header.php';
    
    $categoryName = $_GET['category'];
 
    if (isset($_POST['addToCart'])) {
        
        if (isset($_SESSION['userID'])) {
            $userID = $_SESSION["userID"];
        } else {
            header("Location:../loginRegister/login.php");
        }
        
        $productID = $_POST['productID'];
        $productPrice = $_POST['productPrice'];
        $productName = $_POST['productName'];
        $productImage = $_POST['productImage'];
        $productQuantity = $_POST['productQuantity'];
        $queryExistingCart = "SELECT * FROM cart_items WHERE product_name = '$productName' AND user_id = '$userID'";
        $checkExistingResult = mysqli_query($connection, $queryExistingCart);
    
        if (mysqli_num_rows($checkExistingResult) > 0) { ?>  
            <script type = "text/Javascript"> alert("Product is already in cart, head to cart page to modify quantity");</script>
        <?php
        } else {
            $queryAddToCart = "INSERT INTO `cart_items` (`product_name`, `product_price`, `product_image`, `cart_item_quantity`, `user_id`, `product_id`) VALUES ('$productName', '$productPrice', '$productImage', '$productQuantity', '$userID', '$productID')";
            
            if ($productQuantity == 0) {
                echo '<script type="text/JavaScript">
                alert("That item is Out Of Stock, Please select another item");</script>';
            } else {
                if(mysqli_query($connection, $queryAddToCart)) {
                    echo '<script type="text/JavaScript">
                    alert("Item has been added to cart");</script>';
                } else {
                    echo '<script type="text/JavaScript">
                    alert("An Error has occurred, item was not added to cart");</script>';
                }
            }
        }
    } else {
        null;
    }
?>

<!DOCTYPE html>
<html lang="en" style = "background-color: white;">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?=$categoryName?> </title>
    <link href = "../homepage/homepage.css" rel = "stylesheet" type = "text/css">
    <link href = '../manageProducts/productsAndProfiles.css' rel = 'stylesheet'>
    <link rel="stylesheet" href="../contactUs/inquiriesTable.css">
</head>
<body style = "background-color:white ;">
    <h1 class = "product_title">Products From <?=$categoryName?></h1>
    
    <div style = "background-color: white;" class="modify-inquiry">
        <form style ="background-color: white;" class="inquiry-box" action="#" method="post">
            <input type="text" class="inquiry-form" placeholder="Search Product" name="searchedProduct" required>
            <input type="submit" name="btnSubmit" class="inquiry-submit">
        </form>
        <a href="../viewProducts/productCategory.php?category=<?=$categoryName?>"><button class="inquiry-reset">Reset</button></a>
    </div>

    <section class = "p-category">
        <a href="productCategory.php?category=Fruits">Fruits</a>
        <a href="productCategory.php?category=Vegetables">Vegetables</a>
        <a href="productCategory.php?category=Meat">Meat</a>
    </section>
    <div class = "box-container">
    <?php
        
        if (isset($_POST['btnSubmit'])) {
            $searchedProductName = $_POST['searchedProduct'];;
            $productQuery = "SELECT * FROM products WHERE `product_category` = '$categoryName' AND  `product_name` LIKE '%$searchedProductName%'";
            $result = mysqli_query($connection, $productQuery);
        } else {
            $productQuery = "SELECT * FROM products WHERE `product_category` = '$categoryName'";
            $result = mysqli_query($connection, $productQuery);
        }
    
        $rowCount = mysqli_num_rows($result);
        
        if($rowCount > 0) {
            while ($gatherProducts = mysqli_fetch_assoc($result)) { 
                
                if ($gatherProducts['product_stock'] == 0) {
                    $productStockStatus = "Out of Stock";
                    $setMinValue = 0;
                    $setMaxValue = 0;
                } else {
                    $productStockStatus = $gatherProducts['product_stock'];
                    $setMinValue = 1;
                    $setMaxValue = $gatherProducts['product_stock'];
                } ?>

            <form action = "#" method= "post" class = "item-box">
                <img class ="product-img" src="../images/<?= $gatherProducts['product_image']; ?>" alt = "Picture of Product">
                <div class = "product_name"><?= $gatherProducts['product_name']; ?></div>
                <input type="hidden" name="productID" value="<?= $gatherProducts['product_id']; ?>">
                <input type="hidden" name="productName" value="<?= $gatherProducts['product_name']; ?>">
                <input type="hidden" name="productPrice" value="<?= $gatherProducts['product_price']; ?>">
                <input type="hidden" name="productImage" value="<?= $gatherProducts['product_image']; ?>">
                <div class = "price">RM<span><?= $gatherProducts['product_price']; ?></span>/per unit</div>
                <div>Stock Remaining: <?= $productStockStatus?></div>
                <input class = "input_lengthen" type = "number" min = <?= $setMinValue ?> max = <?= $setMaxValue; ?> name = 'productQuantity' value = <?= $setMinValue ?>>
                <button type="submit" value="Add To Cart" class = "btn" name="addToCart">Add To Cart</button>
            </form>    
        <?php }
    
    } else {
        echo 'No Products from this Category Available';
    }        
        ?>
    </div>
</body>
</html>

<?php
    mysqli_close($connection);
    include '../homepage/footer.php'; 
?>