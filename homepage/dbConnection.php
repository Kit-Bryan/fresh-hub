<?php

    $hostname = "localhost";
    $username = "root";
    $password = "";
    $dbName = "freshhub";


    $connection = mysqli_connect($hostname, $username, $password, $dbName);

    if ($connection === false) {
        die ("Database Connection Error" . "<br>" . mysqli_connect_error());
    }

    else {
        null;
    }
