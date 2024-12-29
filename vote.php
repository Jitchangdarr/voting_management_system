<?php
include 'conetion.php';
$vote = $_REQUEST['vote_id'];
$sql = "UPDATE `voting` SET `status`='vote' WHERE `user_id`='$vote'";
$result = mysqli_query($con, $sql);
if ($result) {
    echo "<script>alert('vote is done')</script>";
    header('location:user.php');
} else {

    echo "vote is not done";
}
