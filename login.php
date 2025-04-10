<?php
include 'connect.php';  // Include the database connection

session_start();  // Start the session at the very beginning

if (isset($_POST['logins'])) {
    // Get the email and password from the form
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Check if the user exists in the database
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Verify the password
        if (password_verify($password, $row['password'])) {
            // Start the session and store user data
            $_SESSION['email'] = $row['email'];
            
            // Redirect to homepage
            header("Location: index.html");
            exit();
        } else {
            echo "Incorrect password.";
        }
    } else {
        echo "Email not found.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title> 
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="main">
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b0/Toronto%2C_City_of.svg/2560px-Toronto%2C_City_of.svg.png" alt="Toronto Logo" class="logo">
        <div class="left">
            <div class="overimage">Welcome to Cypress, </div>
            <div class="small-text">Pinpoint, report, and track street issues in Toronto. </div>   
            
            <img src="https://static-00.iconduck.com/assets.00/toronto-illustration-2048x1336-diief238.png" alt="toronto" class="city">
        </div>
        <div class="right">
            <div class="login" id="logins">
                <h2>Login</h2>
                <form method="post" action="index.html">
                    <div class="input-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" placeholder="Enter your email" required>
                    </div>
                    <div class="input-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" placeholder="Enter your password" required>
                    </div>
                    <div class="links">
                        <p><a href="change-password.html">Forgot Password?</a></p> 
                    </div>
                    <button type="submit" id="loginBtn" class="login-btn">Login</button>
                    <!-- Added onclick to redirect to admin login page -->
                    <button type="button" id="adminBtn" class="login-btn admin-btn" onclick="window.location.href='adminFunc.html';">Login as Admin</button>
                </form>
            
                <div class="links">
                    <p><a href="register.php">Create Account</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
