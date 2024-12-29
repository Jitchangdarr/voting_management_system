<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'conetion.php';
    $name = $_POST['name'];
    $mobile = $_POST['phone'];
    $email = $_POST['mail'];
    $role = $_POST['course'];

    if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
        $stdimg = $_FILES['img']['name'];
        $tmpname = $_FILES['img']['tmp_name'];
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
        $file_extension = pathinfo($stdimg, PATHINFO_EXTENSION);
        if (in_array(strtolower($file_extension), $allowed_extensions)) {
            $folder = 'upload/' . $stdimg;
            if (move_uploaded_file($tmpname, $folder)) {
                // Proceed with inserting data into the database
                $sql = "SELECT * FROM `voting` WHERE `email`='$email'";
                $result = mysqli_query($con, $sql);

                if ($result) {
                    $num = mysqli_num_rows($result);
                    if ($num > 0) {
                        echo 'Email is already registered.';
                    } else {
                        $sql = "INSERT INTO `voting`(`user_id`, `name`, `mobile`, `email`, `role`, `img`, `status`) 
                                VALUES ('', '$name', '$mobile', '$email', '$role', '$folder', 'notvote')";
                        $result = mysqli_query($con, $sql);
                        echo $result ? "Registration successful" : "Error: Could not register. Please try again.";
                        header('location:signup.php');
                    }
                } else {
                    echo "Database query failed.";
                }
            } else {
                echo "Failed to move uploaded file.";
            }
        } else {
            echo "Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed.";
        }
    } else {
        echo "No file uploaded or there was an upload error.";
    }
}



?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>signup</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="signup.css">
</head>

<body>

    <!-- nav bar -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="">HOME</a>
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
        <form method="post" action="" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="studentName" class="form-label">Name</label>
                <input type="text" class="form-control" id="studentName" name="name" aria-describedby="nameHelp"
                    placeholder="Enter Your Name" data-bs-toggle="tooltip" title="Please enter your name" required>
            </div>

            <!-- Phone -->
            <div class="mb-3">
                <label for="phone" class="form-label">Mobile Number</Number></label>
                <input type="number" class="form-control small-input" id="phone" name="phone"
                    placeholder="Enter Your Phone Number" pattern="\d{10}"
                    title="Enter a valid 10-digit phone number" required>
            </div>
            <!-- Email -->
            <div class="mb-3">
                <label for="mail" class="form-label">email</label>
                <input type="mail " class="form-control small-input" id="phone" name="mail"
                    placeholder="Enter Your email" pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" required>
                <small class="form-text text-muted ">
                    Please enter a valid email address.
                </small>
            </div>

            <!-- image upload -->
            <div class="mb-3 pdfUploads mt-5">
                <!-- Styled Label -->

                <!-- Hidden File Input -->
                <label for="pdfUpload" class="form-label">Upload Image</label>
                <input type="file" class="form-control" id="pdfUpload" accept="" name="img" required>
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

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>