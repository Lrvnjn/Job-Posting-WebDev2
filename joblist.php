<?php
// Include your database connection file
require_once 'db.php';

// Fetch all job postings from the database
$query = "SELECT * FROM jobs";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Job Lists</title>
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

        .reg {
            display: block;
            margin: 0 auto;
        }

        .mod {
            font-size: 30px;
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
            font-weight: 300;
        }

        .card {
            margin-bottom: 20px;
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
                        <a class="nav-link text-white me-2" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white me-2" href="about.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white me-5" href="joblist.php">Job Lists</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-light text-primary me-2" href="#" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-warning text-white me-2" href="#" data-bs-toggle="modal" data-bs-target="#registerModal">Signup</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container my-5">
    <h1 class="mb-5">Job List ></h1>
        <div class="row">
            <?php while ($row = mysqli_fetch_assoc($result)) {
                // Get the image thumbnail
                $job_thumb = "uploads/default_thumbnail.png"; // Default image
                if (!empty($row['image'])) {
                    $job_thumb = htmlspecialchars($row['image'], ENT_QUOTES, 'UTF-8');
                }

                echo <<<JOBDATA
                    <div class="col-md-12 d-flex justify-content-center mb-4">
                        <div class="card card-custom">
                            <img src="$job_thumb" class="card-img-top" alt="Job Image">
                            <div class="card-body">
                                <h5 class="card-title">{$row['job_title']}</h5>
                                <p class="card-text"><strong>Company:</strong> {$row['company_name']}</p>
                                <p class="card-text">{$row['job_description']}</p>
                                <p class="card-text"><strong>Email:</strong> {$row['work_email']}</p>
                                <p class="card-text"><strong>Phone:</strong> {$row['phone_number']}</p>
                            </div>
                        </div>
                    </div>
                    JOBDATA;
            } ?>
        </div>
    </div>

    <footer class="footer bg-dark text-white">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>Contact Us</h5>
                    <p>Email: contact@example.com</p>
                    <p>Phone: (123) 456-7890</p>
                </div>
                <div class="col-md-4 text-center">
                    <h5>&copy; 2024 Job Posting</h5>
                    <p>All rights reserved.</p>
                </div>
                <div class="col-md-4 text-end">
                    <h5>Follow Us</h5>
                    <a href="#" class="text-white me-2">Facebook</a>
                    <a href="#" class="text-white me-2">Twitter</a>
                    <a href="#" class="text-white me-2">LinkedIn</a>
                </div>
            </div>
        </div>
    </footer>



    <!-- LoginModal -->
    <div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="login.php" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title d-flex align-items-center mod">
                            <i class="bi bi-person-circle fs-3 me-2"></i> Login
                        </h5>
                        <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Email address</label>
                            <input type="email" name="email" class="form-control shadow-none" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control shadow-none" required>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <button type="submit" class="btn btn-dark shadow-none">LOGIN</button>
                            <a href="#" class="text-secondary text-decoration-none">Forgot Password?</a>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- RegisterModal -->
    <div class="modal fade" id="registerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="register.php" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title d-flex align-items-center mod">
                            <i class="bi bi-person-circle fs-3 me-2"></i> Registration
                        </h5>
                        <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Email address</label>
                            <input type="email" name="email" class="form-control shadow-none" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control shadow-none" required>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <button type="submit" class="btn btn-primary shadow-none reg">REGISTER</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>