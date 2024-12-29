<?php
session_start();
if (isset($_REQUEST['btn'])) {
    include 'conetion.php';
    $mail = $_REQUEST['mail'];
    $number = $_REQUEST['phone'];
    $course = $_REQUEST['course'];
    $sql = "SELECT * FROM `voting` WHERE `email`='$mail' and `mobile`='$number' and `role`='$course'";
    $result = mysqli_query($con, $sql);
    $count = mysqli_num_rows($result);
    $total = mysqli_fetch_assoc($result);//data fetch
    if ($count) {
        if ($total['status'] == 'notvote') {
            $_SESSION['user_id'] = $total['user_id'];
            header('location:user.php');
        } else {
            echo "<script>alert('you are already vote')</script>";
        }
        // group page
        if ($total['role'] == 'Group') {
            $_SESSION['user_id'] = $total['user_id'];
            header('location:group.php');
        }
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="signup.css">
</head>

<body>

    <!-- nav bar -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">HOME</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">



                    <li class="nav-item">
                        <a class="nav-link disabled" aria-disabled="true" href="/ContactUs/contactus.php">CONTACT
                            US</a>
                    </li>

                    <li class="nav-item">
                        <a href="signup.php" class="nav-link active" aria-current="page">LOGIN</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
    <!-- admission part -->
    <div class="container">
        <h1>Student Vote</h1>
        <form method="post">
            <div class="mb-3">
                <label for="mail" class="form-label">email</label>
                <input type="mail " class="form-control small-input" id="phone" name="mail"
                    placeholder="Enter Your email" pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" required>
                <small class="form-text text-muted ">
                    Please enter a valid email address.
                </small>
            </div>
            <!-- Phone -->
            <div class="mb-3">
                <label for="phone" class="form-label">Mobile Number</Number></label>
                <input type="number" class="form-control small-input" id="phone" name="phone"
                    placeholder="Enter Your Phone Number" pattern="\d{10}"
                    title="Enter a valid 10-digit phone number" required>
            </div>
            <!-- vote -->
            <div class="mb-3">
                <label for="course" class="form-label">select your role</label>
                <select class="form-select" id="course" name="course" required>
                    <option value="Voter">Voter</option>
                    <option value="Group">Group</option>
                </select>
            </div>
            <center><button type="submit" name="btn" class="btn btn-primary mt-3">Next</button></center>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>