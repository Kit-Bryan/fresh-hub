<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <!-- Icon -->
    <link rel ="icon" href="../images/transparent_official_logo_plain.png" type="logo/png">
    <!-- Link to style sheet -->
    <link rel="stylesheet" href="login.css">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Calistoga&family=Didact+Gothic&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container">
        <form action="../includes/loginRegisterInc/loginInc.php" class="form" method="POST">
            <a href="../homepage/homepage.php" class="link-home"><img src="../images/transparent_official_logo_black.png" alt="" class="logo"></a>
            <?php
            if (isset($_GET['error'])) {
                if ($_GET['error'] == "badEmail") {
                    echo "<p class='error'>Email does not exist!</p>";
                }
                if ($_GET['error'] == "badPassword") {
                    echo "<p class='error'>Wrong password!</p>";
                }
                // To homepage
                if ($_GET['error'] == "noError") {
                    echo "<p class='noError'>Login Success!</p>";
                    header("Refresh:1, URL=../homepage/homepage.php");
                }
            }
            ?>
            <div class="input-box">
                <input id="email" name="email" type="email" class="box" placeholder=" " required>
                <label for="email">Email</label>
            </div>
            <div class="input-box">
                <input id="password" name="password" type="password" class="box" placeholder=" " required>
                <label for="password">Password</label>
            </div>
            <a href="signup.php" class="register">Register an account</a>
            <button id="submit" name="loginBtn">LOG IN </button>
            <a href="forgotPass.php" class="forgotPass">Forgot password?</a>
        </form>
        <div class="side">
            <img src="https://images.unsplash.com/photo-1584473457406-6240486418e9?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8OXx8c2hvcHBpbmclMjBiYWd8ZW58MHx8MHx8&auto=format&fit=crop&w=500&q=60" alt="Grocery Image">
        </div>
    </div>
</body>

</html>