<?php
if (!isset($_SESSION)) {
    session_start();
}


if (!isset($_SESSION['userID'])) {
    header("Location:../homepage/homepage.php");
    die();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You!</title>
    <!-- Icon -->
    <link rel="icon" href="../images/transparent_official_logo_plain.png" type="logo/png">
    <!-- Link to style sheet -->
    <link rel="stylesheet" href="thankYou.css">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Calistoga&family=Didact+Gothic&display=swap" rel="stylesheet">
    <!-- External Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <!-- Nav bar -->
    <?php
    include_once("header.php")
    ?>

    <div class="container">
        <div class="card">
            <i class="fa-solid fa-circle-check"></i>
            <h1>Thank you!</h1>
            <br>
            <p>Your order is confirmed</p>
            <p class="shipping">We'll send you a shipping confirmation email as soon as your order ships.</p>
            <a href="../homepage/homepage.php">To homepage</a>
        </div>
    </div>

    <!-- Footer -->
    <?php
    include_once("footer.php")
    ?>
</body>

</html>