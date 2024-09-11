<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post_id = intval($_POST['id']);
    $job_title = mysqli_real_escape_string($con, $_POST['job_title']);
    $company_name = mysqli_real_escape_string($con, $_POST['company_name']);
    $job_description = mysqli_real_escape_string($con, $_POST['job_description']);
    $work_email = mysqli_real_escape_string($con, $_POST['work_email']);
    $phone_number = mysqli_real_escape_string($con, $_POST['phone_number']);
    $user_id = $_SESSION['user_id'];

    $query = "UPDATE jobs SET job_title = '$job_title', company_name = '$company_name', job_description = '$job_description', work_email = '$work_email', phone_number = '$phone_number' WHERE id = $post_id AND user_id = $user_id";

    if (mysqli_query($con, $query)) {
        header('Location: dashboard.php');
        exit;
    } else {
        echo "Error updating post: " . mysqli_error($con);
    }
} else {
    echo "Invalid request.";
}
?>
