<?php

    include '../homepage/dbConnection.php';

    if (isset($_POST['submit'])) {

        $productName = $_POST['productName'];
        $productCategory = $_POST['productCategory'] ;
        $productStock = $_POST['productStock'];
        $productPrice = $_POST['productPrice'];
        $productImage = $_FILES['productImage'];
        
        $imageName = $productImage["name"];
        $tempImageName = $productImage["tmp_name"];
        $storage = "../images/" . $imageName;
        
        $imageArray = explode('.', $imageName);
        $imageExt = strtolower(end($imageArray));
        $allowedExt = array('jpg', 'jpeg', 'png', 'jfif', 'pdf', 'gif');
        $imageSize = $productImage['size'];

        $getAllExistingProducts = "SELECT * FROM `products`";  #line 22 - 32, loops existing product into array and checks if product_name already exists
        $existingProductsList = array();
        $existingProductName = mysqli_query($connection, $getAllExistingProducts); 
        
        while ($existingProductResult = mysqli_fetch_assoc($existingProductName)['product_name']) {
            array_push($existingProductsList, $existingProductResult);
        }

        if (in_array($productName, $existingProductsList)) {
            echo '<script>alert("Product name already exists, add a DIFFERENT product!");
                    window.location = ("addProduct.php");
                    </script>';
        } else {

            if (in_array($imageExt, $allowedExt)) {
                if ($imageSize < 5000000){  # 5 MB Size Limit
                    move_uploaded_file($tempImageName, $storage); # Moves image to pictures folder
                    $sqlAddQuery = "INSERT INTO `products` (`product_name`, `product_price`, `product_image`, `product_category`, `product_stock`) VALUES ('$productName', '$productPrice', '$imageName', '$productCategory', '$productStock')";
                    
                    if (mysqli_query($connection, $sqlAddQuery)) {
                        echo '<script>alert("Product Uploaded Successfully!");
                        window.location = ("addProduct.php");
                        </script>';
                    } else {
                        echo "Query Failed";
                    } 

                } else { 
                    echo '<script type="text/JavaScript">   <!-- Alerts user when file exceeds 5MB-->
                    alert("That file uploaded exceeds 5MB, please upload another file");
                    window.location = ("addProduct.php");
                    </script>';
                }

            } else {
                echo '<script type="text/JavaScript">      <!-- Alerts user when file type is not supported-->
                alert("That file type is not allowed, please upload another file");
                window.location = ("addProduct.php");
                </script>';
            }
        }
    }
    mysqli_close($connection);
?>