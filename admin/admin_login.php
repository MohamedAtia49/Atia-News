<?php
    include("../includes/db.php");
    session_start();
    if(isset($_SESSION["admin_id"])){
        $admin_id = $_SESSION["admin_id"];
    }
    if(isset($admin_id)){
        header("location:index.php");
    }
    if(isset($_POST["login"])){
        $email = $_POST["email"];
        $password = $_POST["password"];

        $select_user = mysqli_query($con ,"SELECT * FROM `users` WHERE `email` = '$email' ");
        if (mysqli_num_rows($select_user) > 0) {
            $row = mysqli_fetch_assoc($select_user);
            if (password_verify($password, $row["password"])) {
                if ($row["user_type"] == 'admin') {
                    $_SESSION["admin_name"] = $row["name"];
                    $_SESSION["admin_email"] = $row["email"];
                    $_SESSION["admin_id"] = $row["id"];
                    header("location:index.php");
                }
            }else{
                $message[] = "Incorrect email or password!";
            }
        }else{
            $message[] = "Email isn't exist! please register first! ";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Admin Login</title>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Admin Login Page</h1>
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
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <div style="margin-bottom: 10px;"><a href="admin_register.php" class="btn btn-success">Register Now</a></div>
            <button type="submit" name="login" class="form-control btn btn-primary btn-lg">login</button>
        </form>
    </div>
</body>
</html>