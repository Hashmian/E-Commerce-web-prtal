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
            header('location: index.php'); // Fixed typo in filename
        } else {
            $message[] = 'Incorrect email or password';
        }
    } else {
        $message[] = 'User not found';
    }
}
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
            echo '<div class="message">
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
        <h2>Sign In</h2>
        <form action="#" method="post">
            <div class="form-control">
                <input type="text" name="email" required>
                <label>Email or phone number</label>
            </div>
            <div class="form-control">
                <input type="password" name="password" required>
                <label>Password</label>
            </div>
            <button type="submit" name="login-btn">Sign In</button>
            <div class="form-help"> 
                <div class="remember-me">
                    <input type="checkbox" id="remember-me">
                    <label for="remember-me">Remember me</label>
                </div>
                <a href="#">Need help?</a>
            </div>
        </form>
        <p>Don't have account: <a href="registeration.php">Sign up now</a></p>
        <small>
            This page is protected by Google reCAPTCHA to ensure you're not a bot. 
            <a href="https://developers.google.com/recaptcha">Learn more.</a>
        </small>
    </div>
</body>
</html>