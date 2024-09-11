<?php
require 'db.php'; // Include the db.php file with mysqli connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Prepare the SQL statement
    $sql = "INSERT INTO users (email, password) VALUES ('$email', '$password')";

    // Execute the SQL statement
    if (mysqli_query($con, $sql)) {
        // Redirect to index.php on success
        header('Location: index.php?registration=success');
        exit;
    } else {
        // Check for duplicate email error
        if (mysqli_errno($con) == 1062) {
            // Redirect to index.php with an error query parameter
            header('Location: index.php?registration=email_exists');
        } else {
            // Redirect to index.php with a generic error query parameter
            header('Location: index.php?registration=error');
        }
        exit;
    }
}
?>

