<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>About us</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .navbar {
            position: sticky;
            top: 0;
            z-index: 1000;
            width: 100%;
        }

        .cover {
            width: 100%;
            height: 500px;
            overflow: hidden;
            position: relative;
        }

        .cover img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            top: 0;
            left: 0;
        }

        .about {
            font-size: 24px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .section-title {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .section-content {
            font-size: 18px;
            line-height: 1.6;
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

    <div class="cover">
        <img src="img/HIRING.jpg">
    </div>

    <div class="container my-5">
        <div class="section-title">About Us</div>
        <div class="section-content">
            <p>Welcome to Job Posting, your go-to platform for discovering exciting job opportunities and posting job openings from your company. Our mission is to connect talented individuals with companies looking for skilled professionals, making the job search and hiring process as seamless as possible.</p>
            <p>At Job Posting, we believe that finding the right job or candidate should be easy and efficient. Our platform allows users to:</p>
            <ul>
                <li><strong>Post Job Opportunities:</strong> Companies can quickly and easily list their job openings, reaching a wide audience of potential candidates.</li>
                <li><strong>Browse Job Listings:</strong> Job seekers can explore a variety of job opportunities based on their skills, experience, and preferences.</li>
                <li><strong>Manage Applications:</strong> Employers can review applications, schedule interviews, and make informed hiring decisions all within our platform.</li>
            </ul>
            <p>Our team is dedicated to providing excellent service and support to both job seekers and employers. We are constantly improving our platform to ensure a user-friendly experience and to meet the evolving needs of the job market.</p>
            <p>Thank you for choosing Job Posting. We look forward to helping you achieve your career goals or find the perfect candidate for your team.</p>
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

<!-- DONE! -->