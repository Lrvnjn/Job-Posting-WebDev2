<?php
require 'db.php'; // Include the db.php file with mysqli connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and escape the input data
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = $_POST['password'];

    // Prepare the SQL statement to select the user by email
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($con, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        // Fetch the user data
        $user = mysqli_fetch_assoc($result);

        // Verify the password
        if (password_verify($password, $user['password'])) {
            echo "Login successful!";
            
            // Start a session and set the user ID
            session_start();
            $_SESSION['user_id'] = $user['id'];

            // Redirect to the dashboard
            header('Location: dashboard.php');
            exit;
        } else {
            echo "Invalid email or password.";
        }
    } else {
        echo "Invalid email or password.";
    }
}
?>
