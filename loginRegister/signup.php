<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <!-- Icon -->
    <link rel="icon" href="../images/transparent_official_logo_plain.png" type="logo/png">
    <!-- Link to style sheet -->
    <link rel="stylesheet" href="signup.css">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Calistoga&family=Didact+Gothic&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container">
        <form action="../includes/loginRegisterInc/signupInc.php" class="form" method="POST">
            <a href="../homepage/homepage.php" class="link-home"><img src="../images/transparent_official_logo_black.png" alt="logo" class="logo"></a>
            <?php
            if (isset($_GET['error'])) {
                if ($_GET['error'] == "emptyInputs") {
                    echo "<p class='error'>Please fill in all inputs</p>";
                }
                if ($_GET['error'] == "invalidName") {
                    echo "<p class='error'>Invalid name</p>";
                }
                if ($_GET['error'] == "invalidEmail") {
                    echo "<p class='error'>Invalid email</p>";
                }
                if ($_GET['error'] == "emailExist") {
                    echo "<p class='error'>Email exists, please enter another email</p>";
                }
                if ($_GET['error'] == "invalidPassword") {
                    echo "<p class='error'>Password should be more than or equal to 8 characters</p>";
                }
                // To homepage
                if ($_GET['error'] == "noError") {
                    echo "<p class='noError'>Successfully registered!</p>";
                    header("Refresh:1, URL=../homepage/homepage.php");
                }
            }
            ?>
            <div class="input-box">
                <input id="firstName" name="firstName" type="text" class="box" placeholder=" " required>
                <label for="firstName">First Name</label>
            </div>
            <div class="input-box">
                <input id="lastName" name="lastName" type="text" class="box" placeholder=" " required>
                <label for="lastName">Last Name</label>
            </div>
            <div class="input-box">
                <input id="email" name="email" type="email" class="box" placeholder=" " required>
                <label for="email">Email</label>
            </div>
            <div class="input-box">
                <input id="password" name="password" type="password" class="box" placeholder=" " required>
                <label for="password">Password</label>
            </div>
            <button id="submit" name="loginBtn">SIGN UP </button>
            <a href="login.php" class="register">Have an account registered?</a>
        </form>
        <div class="side">
            <img src="https://images.unsplash.com/photo-1550989460-0adf9ea622e2?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80" alt="Grocery Image">
        </div>
    </div>
</body>

</html>