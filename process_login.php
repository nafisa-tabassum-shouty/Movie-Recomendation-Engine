<?php
// Start the session
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "movie";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get username and password from the form
    $inputUsername = $_POST["username"];
    $inputPassword = $_POST["password"];

    // Validate the username and password
    $sql = "SELECT username, passwords FROM Users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $inputUsername);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        // Username exists in the database
        $backendUsername = $user['username'];
        $backendPassword = $user['passwords'];

        // Now you have $backendUsername and $backendPassword for comparison
        // You can compare $inputUsername with $backendUsername and 
        // $inputPassword with $backendPassword to authenticate the user

        if ($inputUsername == $backendUsername && $inputPassword == $backendPassword) {
            // Authentication successful
            // Store user information in the session
            $_SESSION["username"] = $inputUsername;
			//echo "login successful!";

            // Redirect to a protected page or home page
            header("Location: userDashboard.php");
            exit();
        } else {
            // Authentication failed
            echo "Invalid username or password. Please try again.";
        }
    } else {
        // Username doesn't exist in the database
        echo "Invalid username or password. Please try again.";
    }

    $stmt->close();
}

$conn->close();
?>


