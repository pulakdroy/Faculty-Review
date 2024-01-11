<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="login">
        <h1>Faculty Review</h1>


    <?php
        if (isset($_POST["login"])) {
           $Username = $_POST["username"];
           $Password = $_POST["password"];
            require_once "database1.php";
            $sql = "SELECT * FROM account WHERE Username = '$Username'";
            $result=mysqli_query($conn, $sql);
            $user=mysqli_fetch_array($result, MYSQLI_ASSOC);//to access to the column of database
            if ($user){
                if (password_verify($Password, $user["Password"])){
                    header("Location: index.php");//redirect to home page
                    die();
                }else{
                    echo"<div class= 'alert alert-danger'> password dose not match</div>";
                }
            }else{
                echo"<div class= 'alert alert-danger'> username dose not match</div>";
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
        <p>Don't have an account? <a href="createaccount.html">Create account</a></p>
    </div>
</body>
</html>