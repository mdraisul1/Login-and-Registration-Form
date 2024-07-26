<?php
    session_start();
    if(!isset($_SESSION['user'])){
        header('Location: index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <?php
        //form data submit to database
        if (isset($_POST['submit'])) {
            $fullName = $_POST['FullName'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $passwordRep = $_POST['repeat_password'];

            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            //error handling for registration
            $errors = array();

            //check if fields are empty
            if (empty($fullName) OR empty($email) OR empty($password) OR empty($passwordRep)) {
                array_push($errors, "All fields are required");
            }

            //check if email is valid
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                array_push($errors, "Email is not valid");
            }

            //check if passwords match
            if (strlen($password) < 6) {
                array_push($errors, "Password must be at least 8 characters");
            }

            //check if repeat password matches
            if ($password !== $passwordRep) {
                array_push($errors, "Passwords do not match");
            }

            //no errors, proceed with registration
            require_once 'database.php';
            //email already exists
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $rowCount = mysqli_num_rows($result);
            if($rowCount > 0) {
                array_push($errors, "Email already exists");
            }

            //check if there are any errors
            if (count($errors) > 0) {
                foreach ($errors as $error) {
                    echo "<div class='alert alert-danger'>$error</div>";
                }
            } else {    
                //insert data into database
                $sql = "INSERT INTO users (full_name, email, password) VALUES (?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
                if ($prepareStmt) {
                    mysqli_stmt_bind_param($stmt, "sss", $fullName, $email, $password_hash);
                    mysqli_stmt_execute($stmt);
                    echo "<div class='alert alert-success'>Registration successful</div>";
                } else{
                    echo "<div class='alert alert-danger'>Registration failed</div>";
               }
            }
        }
        ?>
        <form action="registration.php" method="post">
            <div class="form-group">
                <input type="text" class="form-control" name="FullName" id="fullName" placeholder="Full Name">
            </div>
            <div class="form-group">
                <input type="email" class="form-control" name="email" id="email" placeholder="Enter Your Email">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" id="password" placeholder="Enter Your Password">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="repeat_password" id="repeat_password" placeholder="Repeat Your Password">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" name="submit" id="submit" value="Register">
            </div>
        </form>
        <p>Already have an account? <a href="login.php">Login Here</a></p>
    </div>
</body>

</html>