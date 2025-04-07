<?php
include 'connect.php';  // Include the database connection

if (isset($_POST['signup'])) {
    // Sanitize user input to prevent SQL injection
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $password = md5($password);  // Hash the password (consider using password_hash() instead of md5)

    // Check if the email already exists
    $checkEmail = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($checkEmail);

    if ($result->num_rows > 0) {
        echo "Email address already exists.";
    } else {
        // Insert the new user into the database
        $insertQuery = "INSERT INTO users (email, password) VALUES ('$email', '$password')";
        
        if ($conn->query($insertQuery) === TRUE) {
            // Redirect to login page after successful registration
            header("Location: login.php");  // This redirects to the login page
            exit();  // Ensure the script stops after redirection
        } else {
            echo "Error: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title> 
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
            <div class="login" id="signup">
                <h2>Create Account</h2>
                <form method="post" action="register.php"> <!-- Make sure the form submits to register.php -->
                    <div class="input-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Enter your email" required>
                    </div>
                    <div class="input-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Enter your password" required>
                    </div>
                    
                    <div class="links">
                        <p><a href="login.php">Already have an account? Login</a></p> 
                    </div>
                    <button type="submit" name="signup" class="login-btn">Sign Up</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
