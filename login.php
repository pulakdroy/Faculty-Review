<?php
session_start();
if (isset($_SESSION["user"])) {
   header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="container">
        <h1>Faculty Review</h1>

        <?php
        if (isset($_POST["login"])) {
           $username = $_POST["username"];
           $password = $_POST["password"];
            require_once "database1.php";
            $sql = "SELECT * FROM account WHERE Username = '$username'";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if ($user) {
                if (password_verify($password, $user["Password"])) {
                    session_start();
                    $_SESSION["user"] = "yes";
                    header("Location: index.php");
                    die();
                }else{
                    echo "<div class='alert alert-danger'>Password does not match</div>";
                }
            }else{
                echo "<div class='alert alert-danger'>Username does not match</div>";
            }
        }
        ?>
        
        <form action="login.php" method="post" >
            <div class="form-group">
                <input type="text" class="form-control" name="username" class="form-control">
            </div>

            <div class="form-group">
                <input type="password" class="form-control" name="password" class="form-control">
            </div>   
            <div class="form-btn">
                <input type="submit" value="Login" name="login" class="btn btn-primary">

            </div>     
        </form>

        <p>Forget password? <a href="">Forget password</a></p>
        <p>Or</p>
        <p>Don't have an account? <a href="createaccount.php">Create account</a></p>
    </div>
</body>
</html>