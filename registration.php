<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <?php
            //form data submit to database
            if(isset($_POST['submit'])){
                $fullName = $_POST['FullName'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $passwordRep = $_POST['repeat_password'];

                //error handling for registration
                $errors = array();

                //check if fields are empty
                if(empty($fullName) || empty($email) || empty($password) || empty($passwordRep)){
                    array_push($errors, "All fields are required");
                }

                //check if email is valid
                if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    array_push($errors, "Email is not valid");
                }

                //check if passwords match
                if(strlen($password) < 8){
                    array_push($errors, "Password must be at least 8 characters");
                }

                //check if repeat password matches
                if($password != $passwordRep){
                    array_push($errors, "Passwords do not match");
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
    </div>
</body>
</html>