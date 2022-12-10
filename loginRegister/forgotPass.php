<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <!-- Icon -->
    <link rel="icon" href="../images/transparent_official_logo_plain.png" type="logo/png">
    <!-- Link to style sheet -->
    <link rel="stylesheet" href="forgotPass.css">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Calistoga&family=Didact+Gothic&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container">
        <form action="../includes/loginRegisterInc/forgotPassInc.php" class="form" method="POST">
            <img src="../images/transparent_official_logo_black.png" alt="Logo" class="logo">
            <?php
            if (isset($_GET['error'])) {
                if ($_GET['error'] == "badEmail") {
                    echo "<p class='error'>Email does not exist!</p>";
                }
                if ($_GET['error'] == "badPassword") {
                    echo "<p class='error'>Password should be more than or equal to 8 characters!</p>";
                }
                if ($_GET['error'] == "noError") {
                    echo "<p class='noError'>Password successfully changed!</p>";
                    header("Refresh:1, URL=login.php");
                }
            }
            ?>
            <div class="input-box">
                <input id="email" name="email" type="email" class="box" placeholder=" " required>
                <label for="email">Email</label>
            </div>
            <div class="input-box">
                <input id="password" name="password" type="password" class="box" placeholder=" " required>
                <label for="password">New Password</label>
            </div>
            <button id="submit" name="changeBtn">Change password</button>
            <a href="login.php" class="cancel">Cancel</a>
        </form>
    </div>
</body>

</html>