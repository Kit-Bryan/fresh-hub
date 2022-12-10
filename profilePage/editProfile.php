<?php
    include ("../homepage/dbConnection.php");
    include ("../homepage/header.php");

    if (isset($_SESSION['userID'])) {
        $userID = $_SESSION["userID"];
    } else {
        header("Location:../loginRegister/login.php");
    }

    if (isset($_POST['update'])) {
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $address = $_POST['address'];
        $contactNumber = $_POST['contactNumber'];

        $editProfileQuery = "UPDATE users SET `first_name` = '$firstName', `last_name` = '$lastName', `address` = '$address', `contact_number` = '$contactNumber' WHERE `user_id` = '$userID'";
        $executeQuery = mysqli_query($connection, $editProfileQuery);

        if ($executeQuery) {
            echo '<script>alert("Profile has been Updated!");
                        window.location = ("../profilePage/editProfile.php");
                        </script>';
        } else {
            '<script>alert("Profile Update Failed!");
                        window.location = ("../profilePage/editProfile.php");
                        </script>';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link href = "../homepage/homepage.css" rel = "stylesheet" type = "text/css">
    <link href = '../manageProducts/productsAndProfiles.css' rel = 'stylesheet'>
</head>
<body>
    <h1 class = "product_title">Edit Profile
        <img width="30px" src = "../images/edit.png" style = "margin-left:10px;">
    </h1>
    <?php
        $showProfile = "SELECT * FROM users WHERE user_id = '$userID'";
        $result = mysqli_query($connection, $showProfile);
        if (mysqli_num_rows($result) > 0) {
            while ($showProfile = mysqli_fetch_assoc($result)) { ?> 

            <section class = "box-container" style = "grid-template-columns:1fr 1fr;">
                <div class = "item-box" style = "width:100%;" >
                    <div class = "box" style = "padding-bottom:10px; margin-right:100px; width: 50%;">
                        <div>User ID : <?= $showProfile['user_id']; ?></div>
                        <div>First Name : <?= $showProfile['first_name']; ?></div>
                        <div>Last Name : <?= $showProfile['last_name']; ?></div>
                        <div>Email : <?= $showProfile['email']; ?></div>
                        <div>Address : <?= $showProfile['address']; ?></div>
                        <div>Phone Number : <?= $showProfile['contact_number']; ?></div>
                        <div style = "text-transform:capitalize;">Role: <?= $showProfile['role']; ?></div>
                    </div>
                </div>

                <form action = "#" method = "post" class = "submissionForm" style = "margin-left: 100px; width:40%;">
                    First Name: <br> <input class = "input_lengthen" type = "text" name = "firstName" value = "<?= $showProfile['first_name']; ?>" required> <br>
                    Last Name: <br> <input class = "input_lengthen" type = "text" name = "lastName" value = "<?= $showProfile['last_name']; ?>" required> <br>
                    Contact Number: <br> <input class = "input_lengthen" type = "text" min = "0" name = "contactNumber" required value = "<?= $showProfile['contact_number'];?>" > <br>
                    Address: <br> <input style = "height: 50px; length: 150px; margin-top:15px;" type = "text" name = "address" required value = "<?= $showProfile['address'];?>"> <br>
                    <button type = "submit" name = "update" class = "btn" style = "background-color: #E48929; width: 70%; font-size:24px;">Update</button>
                </form> 
            </section>

        <?php }
    } ?>
</body>
</html>

<?php
    mysqli_close($connection);
    include ("../homepage/footer.php");
?>