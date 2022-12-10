<?php
    include "../homepage/dbConnection.php";
    include "../homepage/header.php";

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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href = "../homepage/homepage.css" rel = "stylesheet" type = "text/css">
    <link href = "productsAndProfiles.css" rel ="stylesheet" type = "text/css">
</head>
<body>
    <h1 class = "product_title">Admin Panel</h1>
    <section class = "p-category-image">
        <img src ="../images/manholdinggroceries.jpg">
    </section>
    <section class = "p-category">
        <a href="../manageProducts/addProduct.php">Add Product</a>
        <a href="../manageProducts/updatePage.php">Modify Existing Product</a>
        <a href="../manageProducts/deleteProduct.php">Delete Existing Product</a>
    </section>
</body>
</html>

<?php 
    include "../homepage/footer.php"; 
    mysqli_close($connection);
?>