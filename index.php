<!DOCTYPE html>
<?php
session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Game</title>
    </head>
    <body>
        <table>
            <tr>
        <?php echo "<th>Richtig:  $right </th> <th>Falsch: $wrong</th> <th>Prozent: $percent</th>" ?>
            <tr>
        </table>
        <form action="index.php" method="post">
            <input placeholder="Guess the city!" type="text" name="city">
            <input type="submit" value="Guess!">
        </form>
        <?php
            $servername = "localhost";
            $username = "root";
            $password = "root";
            $dbname = "sightsgamedb";
           

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
                        
            //rnd img anzeigen
            $rnd = rand(1, 3);
            $sql1 = "SELECT * FROM sights WHERE id = $rnd";
            $imgresults = $conn->query($sql1);
            $row1 = $imgresults->fetch_assoc();
            $currentcity = $row1['city'];
            echo  "<img src=".$row1['imgpath']." height='300' width='300'>";
            
            if($_SERVER['REQUEST_METHOD']=="POST"){
                if ($currentcity == $_POST['city']){
                    $right = $right + 1;
                } else {
                    $wrong = $wrong + 1;
                }
            }

            // Auswahlmöglichkeiten geben bzw. Städte ausgeben
            $sql = "SELECT * FROM sights";
            $results = $conn->query($sql);
            if ($results->num_rows > 0) {
                while($row = $results->fetch_assoc()) {
                echo "<p>";
                echo $row['city'];
                echo "</p>";
                }
            } else { echo "Fehler mit der sql in 33";} 
                    
        ?>
    </body>
</html>
