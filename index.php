<!DOCTYPE html>
<?php
session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Guessing Game</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <style>
            body{
                background: url(img/background.jpg) center center;
                background-size: auto auto;
            }
            .input-group {
                position: relative;
                display: table;
                border-collapse: separate;
                padding-bottom: 10px;
            }
            .btn {
                display: inline-block;
                padding: 6px 12px;
                margin-bottom: 0;
                font-size: 50px;
            }
            input.btn-block[type="submit"] {
                width: 100%;
                height: 100px;
            }

            .container {
                padding-right: 15px;
                padding-left: 15px;
                margin-right: auto;
                margin-left: auto;
                margin-top: auto;
                padding-top: 10%;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="jumbotron"> 
                <h1>Guessing Game</h1>
                <form action="game.php" method="post">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="usr" type="text" class="form-control" name="usr" placeholder="Username">
                    </div>
                    <p>
                        <input type="submit" class="btn btn-success btn-block" value="PLAY!">
                    </p>
                </form>
            </div>
                            <a href="login.php">Admin Login</a>

        </div>
    </body>
</html>
