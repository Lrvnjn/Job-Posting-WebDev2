<?php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from POST request
    $id = mysqli_real_escape_string($con, $_POST['id']);
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $company = mysqli_real_escape_string($con, $_POST['company']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);

    // Update query
    $query = "UPDATE jobs SET job_title='$title', company_name='$company', job_description='$description', work_email='$email', phone_number='$phone' WHERE id='$id'";

    if (mysqli_query($con, $query)) {
        header('Location: posts.php');
        exit;
    } else {
        echo 'Error updating job: ' . mysqli_error($con);
    }
}
