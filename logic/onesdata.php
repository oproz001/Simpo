<?php
include '../database/connection.php';

if (isset($_POST['submit'])) {
   if (isset($_POST['uname']) && isset($_POST['uemail']) && isset($_POST['upass']) && isset($_POST['uage']) && isset($_FILES['profilePhoto'])) {


      $username = $_POST['uname'];
      $useremail = $_POST['uemail'];
      $userpass = $_POST['upass'];
      $userregno = $_POST['unumb'];
      $userage = $_POST['uage'];
      $image = $_FILES['profilePhoto'];

      //check if important fields are empty 
      if (empty($username)) {
         $msgerror = 'User name is required';
         header("location: ../index.php?msgerror = $msgerror");
      } else if (empty($useremail)) {
         $msgerror = 'Email is required';
         header("location: ../index.php?msgerror = $msgerror");
      } else if (empty($userregno)) {
         $msgerror = 'Registration Number is required';
         header("location: ../index.php?msgerror = $msgerror");
      } else if (empty($userpass)) {
         $msgerror = 'Password  is required';
         header("location: ../index.php?msgerror = $msgerror");
      }
         else{

         $I_name = $_FILES['profilePhoto']['name'];
         $I_type = $_FILES['profilePhoto']['type'];
         $I_size = $_FILES['profilePhoto']['size'];
         $I_error = $_FILES['profilePhoto']['error'];
         $I_temp = $_FILES['profilePhoto']['tmp_name'];

         if (empty($_FILES['profilePhoto']['name'])) {
            $hasshed_pass = password_hash($userpass, PASSWORD_DEFAULT);

            $userdata = "INSERT INTO users(UserName,UserEmail,UserPassword,UserRegistration,UserAge , profilePhoto) VALUES ('$username', '$useremail','$hasshed_pass', '$userregno' , '$userage' , NULL)";
            $result = mysqli_query($conn, $userdata);

            if ($result) {
               $msg = 'User Added Successfuly';
               header("location: ../index.php?msg= $msg");
            } else {
               echo 'Not Conformed';
            }
         } else {
            $allowed_types = ['jpg', 'jpeg', 'png'];
            $a = explode('/', $I_type);
            $type = $a[1];

            if (!in_array($type, $allowed_types)) {
               echo 'not alloweed';
            } else {
               $new_I_name = $userregno . '-' . $I_name;
               $path = '../uploads/' . $new_I_name;
               $isUploaded = move_uploaded_file($I_temp, $path);
               if (!$isUploaded) {
                  echo "Not Uploaded";
               } else {

                  $hasshed_pass = password_hash($userpass, PASSWORD_DEFAULT);

                  $userdata = "INSERT INTO users(UserName,UserEmail,UserPassword,UserRegistration,UserAge , profilePhoto) VALUES ('$username', '$useremail','$hasshed_pass', '$userregno' , '$userage' , '$new_I_name')";
                  $result = mysqli_query($conn, $userdata);

                  if ($result) {
                     $msg = 'User Added Successfuly';
                     header("location: ../index.php?msg= $msg");
                  } else {
                     echo 'Not Conformed';
                  }
               }
            }
            
         }
      }
   }
} else {
   $msgerror = "Error Occured";
   header("location: ../index.php?msgerror = $msgerror");
}
