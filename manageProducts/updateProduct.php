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

    $productID = $_POST['productID'];
    $sqlFetchDetails = "SELECT * FROM `products` WHERE `product_id` = '$productID'";
    $executeQuery = mysqli_query($connection, $sqlFetchDetails);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update <?=$_POST['productName']?> Page</title>
    <link href = "../homepage/homepage.css" rel = "stylesheet" type = "text/css">
    <link href = "productsAndProfiles.css" rel = "stylesheet">
</head>
<body>
        <?php while ($queryResult = (mysqli_fetch_assoc($executeQuery))) { ?>
        <h1 class = "product_title">Update <?=$queryResult['product_name'] ?> Page</h1>    
        <div class = "box">
                <img class ="product-img" src="../images/<?= $queryResult['product_image']; ?>" alt = "Picture of Product">
                <div>Product ID : <?= $queryResult['product_id']; ?></div>
                <div>Product Name : <?= $queryResult['product_name']; ?></div>
                <div>Product Category : <?= $queryResult['product_category']; ?></div>
                <div>Price : RM<span><?= $queryResult['product_price']; ?></span>/per unit</div>
                <div>Stock Remaining : <?= $queryResult['product_stock']; ?></div>
        </div>

        <form action = "updateProcess.php" method = "post" class = "submissionForm" enctype = "multipart/form-data">
            <input type = "hidden" name = "productID" value = "<?= $queryResult['product_id']; ?>"> <!-- Hidden Product ID-->
            Modify Product Name: <input type = "text" name = "productName" required value = "<?= $queryResult['product_name']; ?>"> <br>
            <section>
                Choose Product Category - 
                <select name = "productCategory" required >
                    <option <?php if ($queryResult['product_category'] == "Fruits") {echo ("selected");}?>>Fruits</option>
                    <option <?php if ($queryResult['product_category'] == "Vegetables") {echo ("selected");}?>>Vegetables</option>
                    <option <?php if ($queryResult['product_category'] == "Meat") {echo ("selected");}?>>Meat</option>
                </select>
            </section>
            Modify Product Price: <input type = "number" name = "productPrice" min = '0' step = 0.01 required value = "<?= $queryResult['product_price']; ?>"> <br>
            Modify Product Stock: <input type = "number" name = "productStock"  min = '0' required value = "<?= $queryResult['product_stock']; ?>"> <br>
            Modify Product Image: <input type = "file" name = "productImage">
            <p style = "font-style: italic; font-size: 12px;">file types allowed - jpg, jpeg, png, jfif, pdf, gif</p>
            <button type = "submit" name = "update" class = "btn" style = "background-color: #E48929; width: 65%;">Update</button>
        </form>
</body>
</html>
        
<?php }
    mysqli_close($connection);
    include '../homepage/footer.php';
?>