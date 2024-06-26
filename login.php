<?php
session_start();
include 'connect.php';

if (isset($_POST['login-btn'])) {
    $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $email = mysqli_real_escape_string($conn, $filter_email);

    $filter_password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    $password = mysqli_real_escape_string($conn, $filter_password);

    $select_user = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'") or die("Query failed");

    if (mysqli_num_rows($select_user) > 0) {
        $result = mysqli_fetch_assoc($select_user);
        if ($result['user_type'] == 'admin') {
            $_SESSION['admin_name'] = $result['name'];
            $_SESSION['admin_email'] = $result['email'];
            $_SESSION['admin_id'] = $result['id'];
            header('location: admin_pannel.php');
        } else if ($result['user_type'] == 'user') {
            $_SESSION['user_name'] = $result['name'];
            $_SESSION['user_email'] = $result['email'];
            $_SESSION['user_id'] = $result['id'];
            header('location: index.html'); // Fixed typo in filename
        } else {
            $message[] = 'Incorrect email or password';
        }
    } else {
        $message[] = 'User not found';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<section class="form-container">
<?php
    if (isset($message)) {
        foreach ($message as $msg) {
            echo '<div class="message">
            <span>'.$msg.'</span>
            <i class="bi bi-x-circle" onclick="this.parentElement.remove()"></i>
            </div>
            ';
        }
    }
    ?>

    <form method="post">
         
<div class="container" id="login">
    <div class="row">
       
        <div class="col-md-7 py-3 py-md-0" id="side2">
            <h3 class="text-center">Account login</h3>
            <p class="text-center">Please login your account, If you'r not register Please Create your account.</p>
            <div class="input2 text-center">
            <label for="N">Name:</label>
            <input type="name" name="email" placeholder="User Name"><br>
            <label for="password">Password:</label>
            <input type="password" name="password" placeholder="password">
            </div>
          <input type="submit" name="login-btn" value="lOG IN">
            <p class="text-center">Forgot Password:<a href="#">Click</a></p>
            <p class="text-center">Creat Account: <a href="Register.php">Click</a></p>
         </div>  
    </div>
   </div>
    </form>
</section>
</body>
</html>
