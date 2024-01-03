<?php 
    include('../includes/db.php');
    session_start();
    if(isset($_SESSION["admin_id"])){
        $admin_id = $_SESSION["admin_id"];
    }
    if(isset($admin_id)){
        header("location:index.php");
    }
    if (isset($_POST["register"])){
        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST['password'];
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $c_password = $_POST['c_password'];
        $hashed_password_confirmation = password_hash($c_password, PASSWORD_DEFAULT);

        if(empty($name) || $name == ''){
            $message[] = 'Name field should not empty';
        }
        elseif(empty($email) || $email == ''){
            $message[] = 'Email field should not empty';
        }
        elseif(empty($password) || $password == ''){
            $message[] = 'Password field should not empty';
        }
        elseif(empty($c_password) || $c_password == ''){
            $message[] = 'Password Confirmation field should not empty';
        }
        elseif($_POST["password"] !== $_POST["c_password"]){
            $message[] = 'Confirm password not matched!';
        }else {
            mysqli_query($con, "INSERT INTO `users`(`name`,`email`,`password`,`user_type`) VALUES('$name','$email','$hashed_password','admin')") or die("query failed");
            $message[] = 'Registered successfully!';
            $message[] = '<a href="admin_login.php">Login Now</a>';
        }
    }
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Admin Register</title>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Admin Register Page</h1>
        <?php
            if (isset($message)) {
            foreach ($message as $message) {
                echo '
                <div class="message">
                    <span style="color:red;">' . $message . '</span>
                    <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
                </div>
                ';
            }
            }
        ?>
        <form action="" method="post">
            <div class="form-group">
                <label for="exampleInputEmail1">Name</label>
                <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" name="c_password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <div style="margin-bottom: 10px;"><a href="admin_login.php" class="btn btn-success">Login Now</a></div>
            <button type="submit" name="register" class="form-control btn btn-primary btn-lg">Register</button>
        </form>
    </div>
</body>
</html>