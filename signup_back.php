<?php
// Start session to manage user signup session
session_start();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if username, email, and password are provided
    if (isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["password"])) {
        // Your signup logic goes here
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Example: Insert user data into database
        // Replace this with your actual database connection and query
        $servername = "localhost";
        $dbusername = "your_database_username";
        $dbpassword = "your_database_password";
        $dbname = "your_database_name";

        // Create connection
        $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Escape user inputs to prevent SQL injection
        $username = mysqli_real_escape_string($conn, $username);
        $email = mysqli_real_escape_string($conn, $email);
        $password = mysqli_real_escape_string($conn, $password);

        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare SQL query to insert user data
        $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";

        if ($conn->query($sql) === TRUE) {
            // Signup successful, redirect user to login page
            $_SESSION["signup_success"] = true;
            header("Location: user_login.html"); // Change this to the desired page after signup
            exit();
        } else {
            // Signup failed, redirect user back to signup page with error message
            $_SESSION["signup_error"] = "Error: " . $sql . "<br>" . $conn->error;
            header("Location: signup.html?error=signup_failed"); // Redirect with error message
            exit();
        }

        // Close connection
        $conn->close();
    } else {
        // Username, email, or password not provided, redirect user back to signup page with error message
        header("Location: signup.html?error=missing_fields"); // Redirect with error message
        exit();
    }
} else {
    // Redirect user back to signup page if accessed directly without submitting the form
    header("Location: signup.html"); // Redirect to signup page
    exit();
}
?>
