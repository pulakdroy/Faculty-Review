
<html>
<head>
    <title>Forgot Password</title>  
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
</head>

<?php
include_once('database1.php');
if(isset($_REQUEST['pwdrst']))
{
  $email = $_REQUEST['Email'];
  $check_email = mysqli_query($connection,"select email from tbl_student where email='$email'");
  $res = mysqli_num_rows($check_email);
  if($res>0)
  {
    $message = '<div>
     <p><b>Hello!</b></p>
     <p>You are recieving this email because we recieved a password reset request for your account.</p>
     <br>
     <p><button class="btn btn-primary"><a href="http://localhost/user-login/passwordreset.php?secret='.base64_encode($email).'">Reset Password</a></button></p>
     <br>
     <p>If you did not request a password reset, no further action is required.</p>
    </div>';

include_once("SMTP/class.phpmailer.php");
include_once("SMTP/class.smtp.php");

$mail = $email; 
$mail = new $mail;
$mail->IsSMTP();
$mail->SMTPAuth = true;                 
$mail->SMTPSecure = "tls";      
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587; 
$mail->Username = "";   //Enter your username/emailid
$mail->Password = "";   //Enter your password
$mail->FromName = "Tech Area";
$mail->AddAddress($email);
$mail->Subject = "Reset Password";
$mail->isHTML( TRUE );
$mail->Body =$message;
if($mail->send())
{
  $msg = "We have e-mailed your password reset link!";
}
}
else
{
  $msg = "We can't find a user with that email address";
}
}

?>
<body>
<div class="container">  
    <div class="table-responsive">  
    <h3>Forgot Password</h3><br/>
    <div class="box">
     <form id="validate_form" method="post" >  
       <div class="form-group">
       <label for="email">Email Address</label>
       <input type="text" name="email" id="email" placeholder="Enter Email" required 
       data-parsley-type="email" data-parsley-trigg
       er="keyup" class="form-control" />
      </div>
      <div class="form-group">
       <input type="submit" id="login" name="pwdrst" value="Send Password Reset Link" class="btn btn-success" />
       </div>
       
       <p class="error"><?php if(!empty($msg)){ echo $msg; } ?></p>
     </form>
     </div>
   </div>  
  </div>
</body>
</html>