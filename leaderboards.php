<!DOCTYPE html>
<?php
session_start()
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Leaderboards</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    </head>
    <body>
        <?php
        //set counter
        if (!isset($counter)) {
            $counter = 0;
        };

        //declare db
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "sightsgamedb";

        //connect to database
        $conn = new mysqli($servername, $username, $password, $dbname);

        //get leaderboard
        $sql = "SELECT * FROM usr ORDER BY points DESC";
        $result = $conn->query($sql);
        ?>
        <!-- Current Stats -->
        <div class="container">
            <div class="well">
                <h3>Your stats</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>right</th>
                            <th>wrong</th>
                            <th>%</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo $_SESSION['usr'] ?></td>
                            <td><?php echo $_SESSION['right'] ?></td>
                            <td><?php echo $_SESSION['wrong'] ?></td>
                            <td><?php echo $_SESSION['percent'] ?></td>
                        </tr>
                    </tbody>
                </table>
                <p>
                <form method="POST" action="#">
                    <input type="submit" value="Insert stats!" name="acceptStats" class="btn btn-info" />
                    <a href="index.php" class="btn btn-success" role="button">Play again!</a>

                </form></p>
                <?php
                    if(isset($_POST['acceptStats'])){
                        echo "<div class='alert alert-info'><strong>One Moment!</strong> We are trying to access our database!</div>";
                        insertIntoMYSQL();
                    } else {
                        echo "<div class='alert alert-warning'><strong>Press Insert stats!</strong> To get your highscore delivered to our database!</div>";
                    }
                ?>
            </div>
            <!-- Leaderboards-->
            <div class="well">
                <h3>Leaderboards</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nr.</th>
                            <th>User</th>
                            <th>Points</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = $result->fetch_assoc()) {
                            $counter = $counter + 1;
                            echo "<tr><td> $counter </td><td>" . $row["usr"] . "</td><td>" . $row["points"] . "</td><td>".$row['date']."</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php
    function insertIntoMYSQL(){
        //declare db
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "sightsgamedb";

        //connect to database
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        //run sql and order after highes score
        $sql = "INSERT INTO usr (id, usr, points, date) VALUES (NULL, '".$_SESSION['usr']."', '".$_SESSION['right']."', '". date("Ymd")."')" ;
            if (mysqli_query($conn, $sql)) {
                echo "<div class='alert alert-success'><strong>Success!</strong> Your are now in our database!</div>";
            } else {
                echo "<div class='alert alert-danger'><strong>Error!</strong> $sqlError" . mysqli_error($conn)."</div>";
            }
            session_destroy();
    }
    ?>


</body>
</html>
