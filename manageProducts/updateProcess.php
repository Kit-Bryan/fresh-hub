<?php
    include '../homepage/dbConnection.php';
    
    if (isset($_POST['update'])) {
        $productID = $_POST['productID'];
        $productName = $_POST['productName'];
        $productPrice = $_POST['productPrice'];
        $productCategory = $_POST['productCategory'];
        $productStock = $_POST['productStock'];
        $productImage = $_FILES['productImage'];

        $imageName = $productImage["name"];
        $tempImageName = $productImage["tmp_name"];
        $storage = "../images/" . $imageName;

        $imageArray = explode('.', $imageName);
        $imageExt = strtolower(end($imageArray));
        $allowedExt = array('jpg', 'jpeg', 'png', 'jfif', 'pdf', 'gif');
        $imageSize = $productImage['size'];

        $currentItem = "SELECT * FROM products WHERE `product_id` = '$productID'";
        $updateDetailsQuery = "UPDATE products SET `product_name` = '$productName', `product_price` = '$productPrice', `product_category` = '$productCategory', `product_stock` = '$productStock' WHERE `product_id` = '$productID'";
        $updateImageQuery = "UPDATE products SET `product_image` = '$imageName' WHERE `product_id` = '$productID'";

        $currentItemConnection = mysqli_query($connection, $currentItem);
        while ($currentImageResult = mysqli_fetch_assoc($currentItemConnection)) {
            $currentImage = $currentImageResult['product_image'];
        }
        $deleteImagePath = "../images/$currentImage";

        if ($productImage['name'] == '') {
            if (mysqli_query($connection, $updateDetailsQuery)) {
                echo '<script>alert("Product Details have been Updated!");
                        window.location = ("../manageProducts/updatePage.php");
                        </script>';
            }
        } else {
            if (in_array($imageExt, $allowedExt)) {
                if ($imageSize < 5000000) {
                    if (mysqli_query($connection, $updateDetailsQuery)) {
                        if (mysqli_query($connection, $updateImageQuery)) {
                            unlink($deleteImagePath);
                            move_uploaded_file($tempImageName, $storage);  #Moves image to pictures folder
                            echo '<script>alert("Product Details and Product Image have been Updated!");
                                window.location = ("../manageProducts/updatePage.php");
                                </script>';
                        } else {
                            echo '<script>alert("Product Update Failed");
                                window.location = ("../manageProducts/updatePage.php");
                                </script>';
                        }
                    }
                } else {
                    echo '<script type="text/JavaScript">   <!-- Alerts user when file exceeds 5MB-->
                    alert("That file uploaded exceeds 5MB, please upload another file");
                        window.location("../manageProducts/updatePage.php");
                    </script>';
                }
            } else {
                echo '<script type="text/JavaScript">      <!-- Alerts user when file type is not supported-->
                        alert("That file type is not allowed, please upload another file");
                        window.location = ("../manageProducts/updatePage.php");
                        </script>';
            }
        }    
    }
mysqli_close($connection);
?>