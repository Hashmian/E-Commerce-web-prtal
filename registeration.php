<?php
// Database connection
include 'connect.php';
if (isset($_POST['submit-btn'])) {
    $filter_name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $name = mysqli_real_escape_string($conn, $filter_name);

    $filter_email = filter_var($_POST['email']);
    $email = mysqli_real_escape_string($conn, $filter_email);

    $filter_password = filter_var($_POST['password']);
    $password = mysqli_real_escape_string($conn, $filter_password);

    $filter_cpassword = filter_var($_POST['cpassword']);
    $cpassword = mysqli_real_escape_string($conn, $filter_cpassword);

    $filter_phone = filter_var($_POST['phone']);
    $phone = mysqli_real_escape_string($conn, $filter_phone);

    $filter_address = filter_var($_POST['address']);
    $address = mysqli_real_escape_string($conn, $filter_address);

    $filter_country = filter_var($_POST['country']);
    $country = mysqli_real_escape_string($conn, $filter_country);
   // $error= array();
  //  if(empty($name) || empty($email) || empty($password))
      //  $error[]="All faileds must be failed";
  //  }else{
      //  if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
       //     $error[]="your email formate is not correct";
       // }
   // }
 
    $select_user = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'") or die("Query failed");

    if (mysqli_num_rows($select_user) > 0) {
        $message[] = "You are already registered.";
    } else {
        if ($password != $cpassword) {
            $message[] = "Passwords do not match.";
        } else {
            mysqli_query($conn, "INSERT INTO users (`name`, `email`, `password`) VALUES ('$name', '$email', '$password')") or die("Query failed");
            $message[] = "Registration successfull.";
        header('location:loginform.php');
        }

    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<!-- Coding By CodingNepal - www.codingnepalweb.com -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E shop Login| CodingNepal</title>
    <link rel="stylesheet" href="registeration.css">
</head>
<body>
<?php
    if (isset($message)) {
        foreach ($message as $msg) {
            echo '<div class="message"
            <span>'.$msg.'</span>
            <i class="bi bi-x-circle" onclick="this.parentElement.remove()"></i>
            </div>
            ';
        }
    }
    ?>

    <nav>
        <a href="index.html"><img src="images/E logo3.png" alt="logo"></a>
    </nav>
    <div class="form-wrapper">
        <h2>Sign up</h2>
        <form action="#" method="post">
            <div class="form-control">
                <input type="text" name="name" required>
                <label>Name</label>
            </div>
            <div class="form-control">
                <input type="country" name="country" required>
                <label>Country name</label>
            </div>
            <div class="form-control">
                <input type="phone" name="phone" required>
                <label>phone number</label>
            </div>
            <div class="form-control">
                <input type="text" name="email" required>
                <label>Email</label>
            </div>
            <div class="form-control">
                <input type="Address" name="address" required>
                <label>Address</label>
            </div>
            <div class="form-control">
                <input type="password"  name="password"required>
                <label>Password</label>
            </div>
            <div class="form-control">
                <input type="password" name="cpassword" required>
                <label>ConfirmPassword</label>
            </div>
            <button type="submit" name="submit-btn">Sign up</button>
            <div class="form-help"> 
                <div class="remember-me">
                    <input type="checkbox" id="remember-me">
                    <label for="remember-me">Remember me</label>
                </div>
                <a href="#">Need help?</a>
            </div>
        </form>
        <p>Already account:<a href="loginform.php">Sign in</a></p>
        <small>
            This page is protected by Google reCAPTCHA to ensure you're not a bot. 
            <a href="https://developers.google.com/recaptcha">Learn more.</a>
        </small>
    </div>
</body>
</html>