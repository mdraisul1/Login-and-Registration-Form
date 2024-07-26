<?php
    session_start();
    if(!isset($_SESSION['user'])){
        header('Location: login.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP & MySQL Projects Tutorials</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="text-center">PHP & MySQL Projects Tutorials</h1>
        <p class="text-center">View <a href="https://github.com/mdraisul1">GitHub</a> for more projects.</p>
        <div class="btn-group">
            <a href="logout.php" class="btn btn-warning">Logout</a>
        </div>
        <div class="btn-group"></div>
            <a href="registration.php" class="btn btn-primary">Registration</a>
        </div>
    </div>
</body>
</html>