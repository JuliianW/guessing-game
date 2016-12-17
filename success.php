<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Success</title>
    </head>
    <body>
        <?php
        //get $var
        $city = $_POST['city'];
        $imgpath = $_POST['imgpath'];

        //declare db
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "sightsgamedb";

        //connect to database
        $conn = new mysqli($servername, $username, $password, $dbname);

        //run sql and order after highes score
        if (isset($city) && isset($imgpath)) {
            $sql = "INSERT INTO sights (id, city, imgpath) VALUES (NULL, '$city', '$imgpath' )";
            if (mysqli_query($conn, $sql)) {
                echo "<div class='alert alert-success'><strong>Success!</strong> Entry successfull!</div>";
            } else {
                echo "<div class='alert alert-danger'><strong>Error!</strong> $sqlError" . mysqli_error($conn) . "</div>";
            }
        }
        ?>
        <a href="login.php">Next enrty!</a>
    </body>
</html>
