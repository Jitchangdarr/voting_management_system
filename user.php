<?php
session_start();
include 'conetion.php'; // Corrected file name
// Retrieve user data
$userid = $_SESSION['user_id'];
$sql = "SELECT * FROM voting WHERE user_id = '$userid'";
$result = mysqli_query($con, $sql);
$data = mysqli_fetch_assoc($result);

if ($data) {
    $YourId = $data['user_id'];
    $userName = $data['name'];
    $email = $data['email'];
    $phone_number = $data['mobile'];
    $img = $data['img'];
    $vote_count = $data['vote_count'];
    $status = $data['status'];
} else {
    $YourId = "Your id was not found";
    $userName = "user name is not found";
    $email = "email was not found";
    $phone_number = "Number was not found";
    $vote_count = 0;
    $status = "Status not found";
}


// Handle vote button click
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn1'])) {
    // Increment vote count in the database
    $sql_update = "UPDATE voting SET vote_count = vote_count + 1 WHERE user_id = '$userid'";
    mysqli_query($con, $sql_update);

    // Re-fetch the updated data
    $result = mysqli_query($con, "SELECT * FROM voting WHERE user_id = '$userid'");
    $data = mysqli_fetch_assoc($result);
    $vote_count = $data['vote_count'];

    // Increment session click count
    if (!isset($_SESSION['click_count'])) {
        $_SESSION['click_count'] = 0;
    }
    $_SESSION['click_count']++;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vote Management System</title>
    <link rel="stylesheet" href="user.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>

<body>
    <a href="index.php">home</a>
    <!-- User Info Section -->
    <div class="header">
        <img src="<?php echo $img; ?>" alt="Profile Picture">
        <h1><?php echo "Your ID: " . $YourId; ?></h1>
        <h1><?php echo "Your Name: " . $userName; ?></h1>
        <h1><?php echo "Your Email: " . $email; ?></h1>
        <h1><?php echo "Your Phone Number: " . $phone_number; ?></h1>
        <h1>Your status: <?php echo $status; ?></h1>
    </div>

    <!-- Voting Section -->
    <form action="" method="post">
        <div class="container">
            <h2>Vote for Your Favorite Party</h2>
            <p><?php echo "You have clicked the button " . $data['vote_count'] . " times."; ?></p>
            <div class="vote-options">
                <div class="vote-option">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/5/50/All_India_Trinamool_Congress_logo.svg" alt="Party 1">
                    <p name='partys' id="partys">Party 1</p>
                    <button name="btn1" class="btn-action" type="submit"><a href="vote.php?vote_id=<?php echo $data['user_id'] ?>">Vote</a></button>
                </div>
                <div class="vote-option">
                    <img src="https://i.pinimg.com/originals/e7/5d/84/e75d84ae6a4544aed7a219969d6ce8eb.jpg" alt="Party 2">
                    <p name='party2'>Party 2</p>
                    <button name="btn2" class="btn-action" type="submit"><a href="vote.php?vote_id=<?php echo $data['user_id'] ?>">Vote</a></button>
                </div>
                <div class="vote-option">
                    <img src="https://www.shutterstock.com/image-vector/hammer-sickle-high-quality-vector-600nw-1899842053.jpg" alt="Party 3">
                    <p name='party3'>Party 3</p>
                    <button name="btn3" class="btn-action" type="submit"><a href="vote.php?vote_id=<?php echo $data['user_id'] ?>">Vote</a></button>
                </div>
                <div class="vote-option">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/a/ad/INC_Logo.png" alt="Party 4">
                    <p name='party4'>Party 4</p>
                    <button name="btn4" class="btn-action" type="submit"><a href="vote.php?vote_id=<?php echo $data['user_id'] ?>">Vote</a></button>
                </div>
            </div>
        </div>
    </form>
</body>

</html>