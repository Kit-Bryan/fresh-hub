<!-- headers -->
<?php include "../homepage/header.php";

if (!isset($_SESSION)) {
    session_start();
}

if (isset($_SESSION['userEmail'])) {
    $userEmail = $_SESSION['userEmail']; //to refer in order_history later
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fresh Hub</title>
    <!-- title logo -->
    <link rel = "icon" href ="images/logo_plain_smol.png" type = "logo/png">
    <!-- homepage css -->
    <link rel="stylesheet" href="orderHistory.css">
    <link rel="stylesheet" href="../homepage/homepage.css">
    <!-- bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <!-- google fonts API -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Calistoga&family=Didact+Gothic&display=swap" rel="stylesheet">
</head>
<body>
<div class="database-order">
    <h1 class="order-header">Order History</h1>
    <div class="order-border"></div>

    <!-- search / delete Order -->
    <div class="search-order">
        <form class="order-box" action="#" method="get">
            <input type="text" class="order-form" placeholder="Search Order ID" name="txtOrderID" required>
            <input type="submit" value="Search" name="btnSubmit" class="order-submit">
        </form>
        <a href="../viewOrderHistory/orderHistory.php"><button class="order-reset">Reset</button></a>
    </div>

    <!-- result table -->
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Contact Number</th>
            <th>Email</th>
            <th>Address</th>
            <th>Total Products</th>
            <th>Total Price</th>
            <th>Payment Mode</th>
        </tr>
        <?php 
            $conn = mysqli_connect("localhost", "root", "", "freshhub");
            if ($conn-> connect_error) {
                die("Connection failed:". $conn-> connect_error);
            }

            $sql = "SELECT inquiry_id, name, email, subject, message FROM inquiries ORDER BY inquiry_id DESC";
            $result = $conn-> query($sql);

            if (isset($_GET['btnSubmit'])) {
                $order_id = $_GET['txtOrderID'];
                $sqlQuery = "SELECT * FROM orders WHERE order_id = '$order_id' AND email = '$userEmail'";
                $result = mysqli_query($conn, $sqlQuery);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo
                    "<tr><td>" . $row["order_id"] . 
                    "</td><td>" . $row["full_name"] .
                    "</td><td>" . $row["contact_number"] .
                    "</td><td>" . $row["email"] .
                    "</td><td>" . $row["address"] .
                    "</td><td>" . $row["total_products"] .
                    "</td><td>" . $row["total_price"] .
                    "</td><td>" . $row["payment_mode"] .
                    "</td></td>";
                }
                echo "</table>";

            } else {
                // $sql = "SELECT inquiry_id, name, email, subject, message FROM inquiries";
                $sql = "SELECT * FROM `orders` WHERE `email` = '$userEmail' ORDER BY order_id DESC";
                $result = $conn-> query($sql);
                while ($row = $result -> fetch_assoc()) {
                    echo 
                    "<tr><td>" . $row["order_id"] . 
                    "</td><td>" . $row["full_name"] .
                    "</td><td>" . $row["contact_number"] .
                    "</td><td>" . $row["email"] .
                    "</td><td>" . $row["address"] .
                    "</td><td>" . $row["total_products"] .
                    "</td><td>" . $row["total_price"] .
                    "</td><td>" . $row["payment_mode"] .
                    "</td></td>";
                }
                echo "</table>";
            }

            $conn-> close();
        ?>
    </table>
</div>

</body>
</html>

<?php include "../homepage/footer.php"?>