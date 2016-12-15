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
                <?php 
                    // stoppt das ständige überschreiben des usernames
                    if(!isset($_SESSION['usr'])){ $_SESSION['usr'] = $_POST['usr']; }; 
                    if(!isset($_SESSION['right'])){ $_SESSION['right'] = 0; }; 
                    if(!isset($_SESSION['wrong'])){ $_SESSION['wrong'] = 0; }; 
                    if(!isset($_SESSION['percent'])){ $_SESSION['percent'] = 0; }; 
                    
                    echo "User: ".$_SESSION['usr']." Right: ".$_SESSION['right']." Wrong: ".$_SESSION['wrong']." Percent: ".$_SESSION['percent']."";
                ?>
            <tr>
        </table>
        <form action="#" method="post">
            <label>City:
                <select name="cityform">
                    <option value="newyork">New York</option>
                    <option value="london">London</option>
                    <option value="paris">Paris</option>
                </select>
                
            </label>
            <input type="submit" value="Guess!">
        </form>
        <?php
            $cityform = $_POST['cityform'];
            
            $servername = "localhost";
            $username = "root";
            $password = "root";
            $dbname = "sightsgamedb";
           
            //function count
            function checkAnswers($cityform, $citydb) {
                if ($cityform === $citydb){
                    $_SESSION['right'] = $_SESSION['right'] + 1;
                    echo "Richtig!<br>";
                } else {
                    $_SESSION['wrong'] = $_SESSION['wrong'] + 1;
                    echo "Falsch!<br>";
                }
            }
            
            echo "Citydb: ".$_SESSION['citydb']."<br>";
            echo "Cityform: $cityform<br>";
            
            checkAnswers($cityform, $_SESSION['citydb']);
            
            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
                        
            //rnd img anzeigen
            $rnd = rand(1, 3);
            $sql1 = "SELECT * FROM sights WHERE id = $rnd";
            $imgresults = $conn->query($sql1);
            $row1 = $imgresults->fetch_assoc();
            $_SESSION['citydb'] = $row1['city'];
                        
            echo  "<img src=".$row1['imgpath']." height='300' width='300'>";
            
           
            
            // Auswahlmöglichkeiten geben bzw. Städte ausgeben
            $sql = "SELECT * FROM sights";
            $results = $conn->query($sql);
            if ($results->num_rows > 0) {
                while($row = $results->fetch_assoc()) {
                echo "<p>";
                echo $row['city'];
                echo "</p>";
                }
            } else { echo "Fehler mit der sql ";} 
                    
        ?>
    </body>
</html>
