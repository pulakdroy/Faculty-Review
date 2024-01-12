<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="account.css">
</head>
<body>
    <div class="container">

      <?php
      if(isset($_POST["submit"])) {
        $First_name=$_POST["First_name"];
        $Last_name=$_POST["Last_name"];
        $user_name=$_POST["User_name"];
        $email=$_POST["Email"];
        $password=$_POST["password"];
        $student_id=$_POST["Student_Id"];
        $phone=$_POST["Phone"];



        $errors=array();

        if(empty( $First_name)OR empty($Last_name) OR empty($user_name) OR empty($email) OR empty($password) OR empty($student_id) OR empty($phone)){
          array_push($errors,"All fields are requred");
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
          array_push($errors,"Email is not valid");
        }
        
        if (strlen($password)<8) {
          array_push($errors, "password must be 8 charecter");
        }
        require_once "database1.php";
        $sql = "SELECT * FROM account WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);
        $rowCount = mysqli_num_rows($result);
        if ($rowCount>0) {
         array_push($errors,"Email already exists!");
        }
        if (count($errors)>0) {
         foreach ($errors as  $error) {
             echo "<div class='alert alert-danger'>$error</div>";
         }
        } else{
          
          $sql="INSERT INTO account (First_name, Last_name,	Username,	Email,	Password,	Student_ID,	Phone) VALUES(?, ?, ?, ?, ?, ?, ?)";
          $stmt=mysqli_stmt_init($conn);
          $prepareStmt=mysqli_stmt_prepare($stmt, $sql);
          if ($prepareStmt){
            mysqli_stmt_bind_param($stmt,"sssssss",$First_name,$Last_name,$user_name,$email,$password,$student_id,$phone);
            mysqli_stmt_execute($stmt);
            echo"<div class= 'alert alert-success'>'You are account have been created'.</div>";
          }else{
            die("somthing went wrong...");
          }
        }
       

      }
      ?>
        <form action="createaccount.php" method="post">
            <div class="form-group">
                <input type="text" class="form-control" name="First_name" placeholder="First name:">
            </div>

            <div class="form-group">
                <input type="text" class="form-control" name="Last_name" placeholder="Last name:">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="User_name" placeholder="Username:">
            </div>
            <div class="form-group">
                <input type="email" class="form-control" name="Email" placeholder="Email:">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password:">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="Student_Id" placeholder="Student ID:">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="Phone" placeholder="Phone number:">
            </div>
            <div class="form-btn">
                <input type="submit" class="btn btn-primary" value="Register" name="submit">
            </div>
        </form>
        <div>
        <div><p>Already Registered <a href="login.php">Login Here</a></p></div>
      </div>
    </div>
</body>
</html>