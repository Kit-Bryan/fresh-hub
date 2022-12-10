<!-- headers -->
<?php include "../homepage/header.php"?>

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
    <link rel="stylesheet" href="inquiriesTable.css">
    <link rel="stylesheet" href="../homepage/homepage.css">
    <!-- bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <!-- google fonts API -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Calistoga&family=Didact+Gothic&display=swap" rel="stylesheet">
</head>
<body>
<div class="database-feedback">
    <h1 class="feedback-header">View Inquiries</h1>
    <div class="feedback-border"></div>

    <!-- search / delete Inquiry -->
    <div class="modify-inquiry">
        <form class="inquiry-box" action="#" method="get">
            <input type="text" class="inquiry-form" placeholder="Search Inquiries ID" name="txtInquiryID" required>
            <input type="submit" value="Search" name="btnSubmit" class="inquiry-submit">
            <input type="submit" value="Delete" name="btnDelete" class="inquiry-delete">
        </form>
        <a href="../contactUs/viewInquiries.php"><button class="inquiry-reset">Reset</button></a>
    </div>

    <!-- result table -->
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Subject</th>
            <th>Message</th>
        </tr>
        <?php 
            $conn = mysqli_connect("localhost", "root", "", "freshhub");
            if ($conn-> connect_error) {
                die("Connection failed:". $conn-> connect_error);
            }

            $sql = "SELECT * FROM inquiries ORDER BY inquiry_id DESC";
            $result = $conn-> query($sql);

            if (isset($_GET['btnSubmit'])) {
                $inquiry_id = $_GET['txtInquiryID'];
                $sqlQuery = "SELECT * FROM inquiries WHERE inquiry_id = '$inquiry_id'";
                $result = mysqli_query($conn, $sqlQuery);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo 
                    "<tr><td class='inquiry-id'>" . $row["inquiry_id"] . 
                    "</td><td class='inquiry-name'>" . $row["name"] .
                    "</td><td class='inquiry-email'>" . $row["email"] .
                    "</td><td class='inquiry-subject'>" . $row["subject"] .
                    "</td><td class='class='inquiry-textarea'>" . $row["message"] .
                    "</td></td>";
                }
                echo "</table>";

            } else if (isset($_GET['btnDelete'])) {
                $inquiry_id = $_GET['txtInquiryID'];
                $sqlQuery = "DELETE FROM `inquiries` WHERE inquiry_id= '$inquiry_id'";
                $result = mysqli_query($conn, $sqlQuery);?>
                <script type="text/JavaScript">
                    setTimeout("location.href = '../contactUs/viewInquiries.php';",0);
                </script>
            <?php }
            else {
                $sql = "SELECT inquiry_id, name, email, subject, message FROM inquiries";
                $result = $conn-> query($sql);
                while ($row = $result -> fetch_assoc()) {
                    echo 
                    "<tr><td class='inquiry-id'>" . $row["inquiry_id"] . 
                    "</td><td class='inquiry-name'>" . $row["name"] .
                    "</td><td class='inquiry-email'>" . $row["email"] .
                    "</td><td class='inquiry-subject'>" . $row["subject"] .
                    "</td><td class='class='inquiry-textarea'>" . $row["message"] .
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