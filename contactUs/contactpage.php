<!-- header -->
<?php include "../homepage/header.php"?>

<!-- html structure -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <!-- title logo -->
    <link rel = "icon" href ="images/logo_plain_smol.png" type = "logo/png">
    <!-- homepage css -->
    <link rel="stylesheet" href="contactpage.css">
    <link rel="stylesheet" href="../homepage/homepage.css">
    <!-- bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <!-- google fonts API -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Calistoga&family=Didact+Gothic&display=swap" rel="stylesheet">
</head>
<body>

<!-- contact page section -->
<div class="contact-section">
    <h1>Contact Us</h1>
    <div class="contact-border"></div>
    <form action="#" class="contact-form" method="get">
        <input type="text" class="contact-form-text" placeholder="Your Name" name="txtName" required>
        <input type="email" class="contact-form-text" placeholder="Your Email" name="txtEmail" required>
        <input type="text" class="contact-form-text" placeholder="Your Subject" name="txtSubject" required>
        <textarea class="contact-form-text" placeholder="Your Message" name="txtMessage" required></textarea>
        <input type="submit" class="contact-form-btn contact-form-btn-animation" value="Submit" name="btnSubmit">

<!-- display status message after submission -->
        <?php 
        include('../homepage/dbConnection.php'); 
        if(isset($_GET['btnSubmit'])) {
            $name = $_GET['txtName'];
            $email = $_GET['txtEmail'];
            $subject = $_GET['txtSubject'];
            $message = $_GET['txtMessage'];
            $query = "INSERT INTO `inquiries` (`name`, `email`, `subject`, `message`) VALUES ('$name','$email','$subject','$message')";
            if (mysqli_query($connection, $query)) {
                mysqli_close($connection);
                echo "<p class='btn-response-message'>Thank you for submitting your query! We will get back to you soon!</p>"; ?>
                <script type="text/JavaScript">
                    setTimeout("location.href = '../homepage/homepage.php';",2000);
                </script>

            <?php } else {
                mysqli_close($connection);
                echo "<p class='btn-response-message'>Failed to send feedback"; ?>
                <script type="text/JavaScript">
                    setTimeout("location.href = '../contactUs/contactpage.php';",2000);
                </script>
            <?php }
        }
        ?>
    </form>
</div>

</body>
</html>

<!-- footer -->
<?php include "../homepage/footer.php"?>
<!-- end -->

