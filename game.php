<!DOCTYPE html>
<?php
session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Game</title>
        <!-- Test commit! -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    </head>
    <body>
        <?php
        // stoppt das ständige überschreiben des usernames
        if (!isset($_SESSION['usr'])) {
            $_SESSION['usr'] = $_POST['usr'];
        };
        if (!isset($_SESSION['right'])) {
            $_SESSION['right'] = 0;
        };
        if (!isset($_SESSION['wrong'])) {
            $_SESSION['wrong'] = 0;
        };
        if (!isset($_SESSION['percent'])) {
            $_SESSION['percent'] = 0;
        };
        $_SESSION['n'] = $_SESSION['wrong'] + $_SESSION['right'];
        $_SESSION['percent'] = $_SESSION['right'] / $_SESSION['n'] * 100;
        ?>
        <div class="container">
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
            <div class="row">
                <div class="col-sm-4">
                    <div class = "well">
                        <h3>Input</h3><hr>
                    <h4>Your guess!</h4>

                    <form action="#" method="post">
                        <label>
                            <select name="cityform" size="1">
                                <option value="newyork">New York</option>
                                <option value="london">London</option>
                                <option value="paris">Paris</option>
                            </select>
                        </label>
                    <input type="submit" class="btn btn-primary" value="Guess!">
                    <input type="submit" class="btn btn-danger" name="cancel" value="Save & Exit!">
                    </form>
                    
                    </div>

                    <?php
                    if(isset($_POST['cancel'])){
                        updateBoards();
                    }
                    
                    $cityform = $_POST['cityform'];

                    $servername = "localhost";
                    $username = "root";
                    $password = "root";
                    $dbname = "sightsgamedb";
                    
                    // Create connection
                    $conn = new mysqli($servername, $username, $password, $dbname);

                    
                    function updateBoards(){  
                        $conn = new mysqli($servername, $username, $password, $dbname);
                        $sql = "INSERT INTO 'usr' ('id' , 'username', 'points', 'percentage', 'date') VALUES (NULL,'".$_SESSION['usr']."', '".$_SESSION['right']."', '".$_SESSION['percent']."', '".  date('Y-m-j')."' )";
                        if ($conn->query($sql) === TRUE) {
                            echo "New record created successfully";
                        } else {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                        }
                    }
                    
                    function checkAnswers($cityform, $citydb) {
                        if ($cityform === $citydb) {
                            $_SESSION['right'] = $_SESSION['right'] + 1;
                            echo "<div class='alert alert-success'><strong>Success!</strong> Your answer is correct!</div>";
                        } else {
                            $_SESSION['wrong'] = $_SESSION['wrong'] + 1;
                            echo "<div class='alert alert-danger'><strong>Wrong!</strong> Your answer was false! Try again!</div>";
                        }
                    }

                    echo "Citydb: " . $_SESSION['citydb'] . "<br>";
                    echo "Cityform: $cityform<br>";
                    echo "</div>";

                    echo "<div class='col-sm-4'>";
                    echo "<div class='well'>";
                    echo "<h3>Image</h3>";

                    checkAnswers($cityform, $_SESSION['citydb']);


                    //rnd img anzeigen
                    $rnd = rand(1, 3);
                    $sql1 = "SELECT * FROM sights WHERE id = $rnd";
                    $imgresults = $conn->query($sql1);
                    $row1 = $imgresults->fetch_assoc();
                    $_SESSION['citydb'] = $row1['city'];

                    echo "<img src=" . $row1['imgpath'] . "  width='100%'>";
                    echo "</div>";
                    echo "</div>";
                    
                    
                    $sql = "SELECT * FROM usr";
                    $result = $conn->query($sql);
                    
                   
                    ?>
                    <div class="col-sm-4">
                        <div class='well'>
                        <h3>Leaderboards</h3>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User</th>
                                    <th>Points</th>
                                    <th>%</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <?php
                                    while($row = $result->fetch_assoc()) {
                                        echo "<tr><td> test </td><td>" . $row["username"]. "</td><td>" . $row["points"]."</td><td>".$row['percentage']."</td></tr>";
                                    }      ?>                           
                                
                           </tbody>
                        </table>
                        </div>
                    </div>    
                </div>
                </body>
                </html>
