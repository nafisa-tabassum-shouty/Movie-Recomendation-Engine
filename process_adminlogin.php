<?php
// Start the session
session_start();


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get username and password from the form
    $inputUsername = $_POST["username"];
    $inputPassword = $_POST["password"];

    // Validate the username and password
    
        $backendUsername = 'root';
        $backendPassword = '12345678';

        // Now you have $backendUsername and $backendPassword for comparison
        // You can compare $inputUsername with $backendUsername and 
        // $inputPassword with $backendPassword to authenticate the user

        if ($inputUsername == $backendUsername && $inputPassword == $backendPassword) {
            // Authentication successful
            // Store user information in the session
            $_SESSION["username"] = $inputUsername;
			//echo "login successful!";

            // Redirect to a protected page or home page
            header("Location: adminDashboard.php");
            exit();
        } else {
            // Authentication failed
            echo "Invalid username or password. Please try again.";
        }
    } else {
        // Username doesn't exist in the database
        echo "Invalid username or password. Please try again.";
    }

?>

