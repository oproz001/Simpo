<?php
include "../database/connection.php";

if (isset($_POST['userID'])) {
    $userID = $_POST['userID'];
    $username = $_POST['uname'];
    $useremail = $_POST['uemail'];

    $userregno = $_POST['unumb'];
    $userage = $_POST['uage'];

    $sql = "UPDATE users SET UserName = '$username' , UserEmail = '$useremail' , UserRegistration = '$userregno', UserAge = '$userage' WHERE userID = '$userID' ";
    $results = mysqli_query($conn, $sql);

    if (!$results) {
        header("location: ../index.php?msgerror= Update Failed");
    } else {
        header("location: ../index.php?msg= Update successfully");
    }
} else {
    header("location: ../index.php?msgerror= Something Went Wrong");
}
