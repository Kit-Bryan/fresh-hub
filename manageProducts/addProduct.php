<?php 
    include "../homepage/dbConnection.php";
    include ("../homepage/header.php"); 

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
    <title>Add Products</title>
    <link href = "../homepage/homepage.css" rel = "stylesheet" type = "text/css">
    <link href = "productsAndProfiles.css" rel ="stylesheet" type = "text/css">
</head>
<body>
    <h1 class = "product_title">Add Product</h1>
    <div>
        <form action = "uploadFile.php" method = "post" enctype = "multipart/form-data" class = "submissionForm">
            Insert Product Name: <input type = "text" name = "productName" required> <br> 
            <section>
                Choose Product Category - 
                <select name = "productCategory" required>
                    <option value = "Fruits">Fruits</option>
                    <option value = "Vegetables">Vegetables</option>
                    <option value = "Meat">Meat</option>
                </select>
            </section>
            Insert Product Stock: <input type = "number" name = "productStock"  min = '0' required> <br>
            Insert Product Price: <input type = "number" name = "productPrice" min = '0' step = 0.01 required> <br>
            Insert Product Image: <input type = "file" name = "productImage" required>
            <p style = "font-style: italic; font-size: 12px;">file types allowed - jpg, jpeg, png, jfif, pdf, gif</p>
            <button type = "submit" name = "submit" class = "btn">Upload</button>
        </form>
    </div>
</body>
</html>

<?php
    include '../homepage/footer.php';
    mysqli_close($connection);
?>