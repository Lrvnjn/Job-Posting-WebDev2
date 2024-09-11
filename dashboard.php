<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

include 'db.php';

$user_id = $_SESSION['user_id'];

// Fetch the user's email from the database
$query = "SELECT email FROM users WHERE id = $user_id";
$result = mysqli_query($con, $query);

if ($result) {
    $user = mysqli_fetch_assoc($result);
    $user_email = $user['email'];
} else {
    $user_email = ''; // Default to an empty string if there's an error
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle file upload
    if (isset($_FILES['job_image']) && $_FILES['job_image']['error'] === UPLOAD_ERR_OK) {
        $image_name = $_FILES['job_image']['name'];
        $image_tmp_name = $_FILES['job_image']['tmp_name'];

        // Define upload directory
        $upload_dir = __DIR__ . '/uploads/'; // Use absolute path

        // Make sure the uploads directory exists
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true); // Create the directory if it doesn't exist
        }

        $upload_file = $upload_dir . basename($image_name);

        // Move the uploaded file to the uploads directory
        if (move_uploaded_file($image_tmp_name, $upload_file)) {
            // Insert job details into the database using mysqli
            $job_title = mysqli_real_escape_string($con, $_POST['job_title']);
            $company_name = mysqli_real_escape_string($con, $_POST['company_name']);
            $job_description = mysqli_real_escape_string($con, $_POST['job_description']);
            $work_email = mysqli_real_escape_string($con, $_POST['work_email']);
            $phone_number = mysqli_real_escape_string($con, $_POST['phone_number']);
            $image_path = 'uploads/' . basename($image_name);

            $query = "
                INSERT INTO jobs (job_title, image, company_name, job_description, work_email, phone_number) 
                VALUES ('$job_title', '$image_path', '$company_name', '$job_description', '$work_email', '$phone_number')
            ";

            if (mysqli_query($con, $query)) {
                echo "<script>
                    alert('success', 'Job posting successfully created!');
                </script>";
            } else {
                echo "<script>
                    alert('danger', 'Error: " . mysqli_error($con) . "');
                </script>";
            }
        } else {
            echo "<script>
                alert('danger', 'Sorry, there was an error uploading your file.');
            </script>";
        }
    } else {
        echo "<script>
            alert('danger', 'No file uploaded or there was an upload error.');
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a post</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
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

    .reg {
        display: block;
        margin: 0 auto;
    }

    .mod {
        font-size: 30px;
        font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
        font-weight: 300;
    }

    .custom-alert {
        position: fixed;
        top: 80px;
        right: 25px;
        z-index: 1050;
    }
</style>

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

    <div class="container mt-5">
        <h2>Create a Job Posting</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="job_title" class="form-label">Job Title:</label>
                <input type="text" class="form-control" id="job_title" name="job_title" required>
            </div>
            <div class="mb-3">
                <label for="job_image" class="form-label">Picture:</label>
                <input type="file" class="form-control" id="job_image" name="job_image" required>
            </div>
            <div class="mb-3">
                <label for="company_name" class="form-label">Company Name:</label>
                <input type="text" class="form-control" id="company_name" name="company_name" required>
            </div>
            <div class="mb-3">
                <label for="job_description" class="form-label">Job Description:</label>
                <textarea class="form-control" id="job_description" name="job_description" rows="5" required></textarea>
            </div>
            <div class="mb-3">
                <label for="work_email" class="form-label">Work Email:</label>
                <input type="email" class="form-control" id="work_email" name="work_email" value="<?php echo htmlspecialchars($user_email, ENT_QUOTES, 'UTF-8'); ?>" readonly style="background-color: #f0f0f0; color: #6c757d;" required>
            </div>
            <div class="mb-3">
                <label for="phone_number" class="form-label">Phone Number:</label>
                <input type="tel" class="form-control" id="phone_number" name="phone_number" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit Job Posting</button>
        </form>
    </div>

    <?php
    function alert($type, $msg)
    {
        $bs_class = ($type == "success") ? "alert-success" : "alert-danger";
        echo <<<ALERT
    <div class="custom-alert alert $bs_class alert-dismissible fade show" role="alert">
        <strong class="me-3">$msg</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    ALERT;
    }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        function remAlert() {
            let alert = document.getElementsByClassName('custom-alert');
            if (alert.length > 0) {
                setTimeout(function() {
                    alert[0].remove();
                }, 2000);
            }
        }

        remAlert(); // Call this function after generating the alert
    </script>

</body>

</html>

<!-- DONE! -->