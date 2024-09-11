<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

include 'db.php';

$user_id = $_SESSION['user_id'];

// Fetch user's email from the database
$email_query = "SELECT email FROM users WHERE id = $user_id";
$email_result = mysqli_query($con, $email_query);

if (!$email_result) {
    die('Error executing query: ' . mysqli_error($con));
}

$user = mysqli_fetch_assoc($email_result);
if (!$user) {
    die('User not found.');
}

$user_email = $user['email'];

// Fetch job posts based on user's email
$query = "SELECT * FROM jobs WHERE work_email = '$user_email'";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Job Posts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .navbar {
            position: sticky;
            top: 0;
            z-index: 1000;
            width: 100%;
        }

        .job {
            font-size: 30px;
            font-family: Georgia, 'Times New Roman', Times, serif;
            margin-left: 40px;
        }

        .nav-item a {
            font-size: 20px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .card-custom {
            width: 70%;
            margin: 0 auto;
        }

        .card-img-top {
            height: 500px;
            object-fit: cover;
        }

        .footer {
            padding: 20px 0;
            background-color: #343a40;
            color: #ffffff;
        }

        .footer h5 {
            margin-bottom: 15px;
            font-weight: bold;
        }

        .footer p {
            margin-bottom: 10px;
        }

        .footer a {
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark" style="width: 100%;">
        <div class="container-fluid">
            <a class="navbar-brand text-white job" href="#">Job Posting</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link text-white me-2" href="dashboard.php">Post</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white me-5" href="posts.php">My Posts</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-light text-primary me-2" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <div class="row">
            <?php while ($row = mysqli_fetch_assoc($result)) {
                // Get the image thumbnail
                $job_thumb = "uploads/default_thumbnail.png"; // Default image
                if (!empty($row['image'])) {
                    $job_thumb = htmlspecialchars($row['image'], ENT_QUOTES, 'UTF-8');
                }

                $job_id = htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8');
                $job_title = htmlspecialchars($row['job_title'], ENT_QUOTES, 'UTF-8');
                $company_name = htmlspecialchars($row['company_name'], ENT_QUOTES, 'UTF-8');
                $job_description = htmlspecialchars($row['job_description'], ENT_QUOTES, 'UTF-8');
                $work_email = htmlspecialchars($row['work_email'], ENT_QUOTES, 'UTF-8');
                $phone_number = htmlspecialchars($row['phone_number'], ENT_QUOTES, 'UTF-8');

                echo <<<JOBDATA
                    <div class="col-md-12 d-flex justify-content-center mb-4">
                        <div class="card card-custom">
                            <img src="$job_thumb" class="card-img-top" alt="Job Image">
                            <div class="card-body">
                                <h5 class="card-title">{$job_title}</h5>
                                <p class="card-text"><strong>Company:</strong> {$company_name}</p>
                                <p class="card-text">{$job_description}</p>
                                <p class="card-text"><strong>Email:</strong> {$work_email}</p>
                                <p class="card-text"><strong>Phone:</strong> {$phone_number}</p>
                                <button class="btn btn-warning me-2" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editModal" 
                                        data-id="{$job_id}" 
                                        data-title="{$job_title}" 
                                        data-company="{$company_name}" 
                                        data-description="{$job_description}" 
                                        data-email="{$work_email}" 
                                        data-phone="{$phone_number}">
                                    Edit
                                </button>                                
                                <a href="delete.php?id={$job_id}" class="btn btn-danger">Delete</a>
                            </div>
                        </div>
                    </div>
                JOBDATA;
            } ?>
        </div>
    </div>

    <!-- EditModal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="edit.php" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Job Posting</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="editJobId">
                        <div class="mb-3">
                            <label class="form-label">Job Title</label>
                            <input type="text" name="title" id="editJobTitle" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Company Name</label>
                            <input type="text" name="company" id="editCompanyName" class="form-control" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Job Description</label>
                            <textarea name="description" id="editJobDescription" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" id="editJobEmail" class="form-control" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Phone Number</label>
                            <input type="text" name="phone" id="editJobPhone" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ovO8RPLM84Il0zw5NlFZ+3/wE4RzzlAZdBRk2Q8mBl9SM4qI4Azv1k0AI8tF0y7D" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var editModal = document.getElementById('editModal');
            editModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;

                // Extract data attributes from the button
                var jobId = button.getAttribute('data-id');
                var jobTitle = button.getAttribute('data-title');
                var companyName = button.getAttribute('data-company');
                var jobDescription = button.getAttribute('data-description');
                var jobEmail = button.getAttribute('data-email');
                var jobPhone = button.getAttribute('data-phone');

                // Update modal form fields
                var modal = editModal.querySelector('form');
                modal.querySelector('#editJobId').value = jobId;
                modal.querySelector('#editJobTitle').value = jobTitle;
                modal.querySelector('#editCompanyName').value = companyName;
                modal.querySelector('#editJobDescription').value = jobDescription;
                modal.querySelector('#editJobEmail').value = jobEmail;
                modal.querySelector('#editJobPhone').value = jobPhone;
            });
        });
    </script>

</body>

</html>