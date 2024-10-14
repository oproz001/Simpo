<?php

include "../database/connection.php";

    if(isset($_GET['id'])){
        $userId = $_GET['id'];
        $sql = "DELETE FROM users WHERE UserID = $userId";
        $result = mysqli_query($conn,$sql);
   

    if($result){
        header("location: ../index.php?msg=User Deleted Successifly");
    }
    else{
        echo  "error";
    }
 }else{
    header("location: ../index.php?msgerror = error");
 }