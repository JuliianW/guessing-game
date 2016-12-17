<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>backend</title>
    </head>
    <body>
        <?php
        if (isset($_POST['send'])) {
            echo "<p>Your password gets checked!</p>";
            if ($_POST['pwd'] === "root") {
                echo "<p>You are now logged in!</p><hr>";
                $_SESSION['admin'] = TRUE;
            } else {
                echo "<p>Wrong pwd. <a href='index.php'>EXIT</a></p>";
            }
        } else {
            echo "<p>Enter your pwd pls!</p>";
        }
        //wenn PWD richtig --> amdmin true, etc.    
        if ($_SESSION['admin']) {
            ?>
            <h3>New entry</h3>
            <form method="POST" action="success.php">
                <input type="text" placeholder="city" name="city">
                <input type="text" placeholder="path/toimg.jpg" name="imgpath">
                <input type="submit" name="send">
            </form>
            <?php
//            //get $var
//            $city = $_POST['city'];
//            $imgpath = $_POST['imgpath'];
//
//            //declare db
//            $servername = "localhost";
//            $username = "root";
//            $password = "root";
//            $dbname = "sightsgamedb";
//
//            //connect to database
//            $conn = new mysqli($servername, $username, $password, $dbname);
//
//            //run sql and order after highes score
//            if (isset($city) && isset($imgpath)) {
//                $sql = "INSERT INTO sights (id, city, imgpath) VALUES (NULL, '$city', '$imgpath' )";
//                if (mysqli_query($conn, $sql)) {
//                    echo "<div class='alert alert-success'><strong>Success!</strong> Entry successfull!</div>";
//                } else {
//                    echo "<div class='alert alert-danger'><strong>Error!</strong> $sqlError" . mysqli_error($conn) . "</div>";
//                }
//            }

//            //get current sights
//            $sql1 = "SELECT * FROM sights ORDER BY id";
//            $result = $conn->query($sql1);
//            while ($row = $result->fetch_assoc()) {
//                echo "<p>" . $row['city'] . "-->" . $row['imgpath'] . "</p>";
//            }
//            
            ?>










            <?php
        }
        ?>        
    </body>
</html>
