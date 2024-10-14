<?php
  include 'database/connection.php';

  $sql = "SELECT * FROM users";
  $users = mysqli_query($conn,$sql);

  if(isset($_GET['id'])){
   
  
    $userID = $_GET['id'];

    $sql = "SELECT * FROM users where userID = '$userID'";
    $results = mysqli_query($conn,$sql);

    if(mysqli_num_rows($results) > 0){
        $result = mysqli_fetch_assoc($results);
    }else{
        echo "failed to the database";
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    
    <link rel="stylesheet" href="style/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="style/index.css">
</head>
<body>

    <div class="container text-center">
        <!-- Carousel -->
        <div id="infoCarousel" class="carousel slide w-100 mb-4" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="assets/image.png" class="d-block w-100" alt="Registration">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Easy Registration</h5>
                        <p>Sign up quickly and easily. Your journey starts here!</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="assets/loginslide.avif" class="d-block w-100" alt="Login">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Secure Login</h5>
                        <p>Log in securely with your credentials. Your data is safe with us!</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="assets/secure.jpg" class="d-block w-100" alt="Safety">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Your Safety Matters</h5>
                        <p>We prioritize your safety with top-notch security measures.</p>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#infoCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#infoCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
            <!-- Form For Registeration -->
        <div class="form-container">
            <h1><?=(isset($result) ? 'Edit User Registration': 'User Registration')?></h1> 

            <form action="<?= (isset($result) ? 'logic/edit.php' : 'logic/onesdata.php')?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name" class="form-label">Username:</label>
                    <input type="text" class="form-control" name="uname" id="name" value="<?= $result['UserName'] ?? null ?>" >
                </div>

                <input type="hidden" name="userID" value="<?= $result['UserID'] ?>">

                <div class="form-group">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" name="uemail" id="email" value="<?= $result['UserEmail'] ?? null ?>" >
                </div>
                    <?php if(!isset($result)){ ?>
                <div class="form-group">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" class="form-control" name="upass" id="password"  >
                </div>
                        <?php } ?>
                <div class="form-group">
                    <label for="regno" class="form-label">Registration Number: </label>
                    <input type="number" class="form-control" name="unumb" value="<?= $result['UserRegistration']?? null ?>" id="regno" >
                </div>

                <div class="form-group">
                    <label for="age" class="form-label">Age:</label>
                    <input type="number" class="form-control" name="uage"  value="<?= $result['UserAge'] ?? null ?>" id="age">
                </div>

                <div class="form-group">
                    <label for="profilePhoto" class="form-label">Profile Photo:</label>
                    <input type="file" class="form-control" name="profilePhoto" id="profilePhoto">
                </div>

                <button id="submitButton" class="btn btn-submit" name="submit" type="submit" onclick="submitForm()">
            Submit <span id="spinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
        </button>
            </form>
        </div>

        <div class="table-container">
            <?php if (mysqli_num_rows($users) > 0) { ?>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                           <div class="d-flex justify-content-between">
                               <h4> Registered Candidates </h4>
                               <a href="?msg= Hey there " class="btn btn-outline-info">Create New Candidates</a>
                           </div>
                                                          
                        </tr>
                        <tr>
                            <th>S/N</th>
                            <th>Profile</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Registration</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; foreach($users as $user) { 
                            $profilePic = !empty($user['profilePhoto']) ? 'uploads/' . $user['profilePhoto'] : 'https://via.placeholder.com/50?text=' . strtoupper($user['UserName'][0]);

                            ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><img src="<?= $profilePic ?>" alt="Profile Pic" class="img-thumbnail img-fluid rounded-circle" style="width: 50px; height: 50px; object-fit: cover;"></td>
                                <td><?= htmlspecialchars($user['UserName']) ?></td>
                                <td><?= htmlspecialchars($user['UserEmail']) ?></td>
                                <td><?= htmlspecialchars($user['UserRegistration']) ?></td>
                                <td>
                                    <a href="?id=<?= $user['UserID']?>" class="btn btn-edit btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <a href="./logic/deleteUser.php?id=<?= $user['UserID'] ?>" class="btn btn-delete btn-sm">
                                        <i class="fas fa-trash"></i> Delete
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } else { ?>
                <div class="alert alert-warning text-center">
                    No users registered yet.
                </div>
            <?php } ?>

        </div>
        
        </div>
    </div>

    <!-- Toast Notification -->
    <div id="toast" class="toast bg-success text-white" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="me-auto">Success</strong>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            <?php if(isset($_GET['msg'])) { ?>
                <?= $_GET['msg'] ?>
            <?php } ?>
        </div>
    </div>
    <div id="toast" class="toast bg-danger text-white" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="me-auto">Error</strong>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            <?php if(isset($_GET['msgerror'])) { ?>
                <?= $_GET['msgerror'] ?>
            <?php } ?>
        </div>
    </div>

    <script src="style/js/bootstrap.bundle.min.js"></script>

    <script>
        // Show toast notification for 5 seconds
        const toast = document.getElementById('toast');
        if (toast) {
            const bsToast = new bootstrap.Toast(toast, { autohide: true, delay: 5000 });
            setTimeout(() => {
                toast.classList.add('show'); // Fade in
                bsToast.show();
                setTimeout(() => {
                    toast.classList.remove('show'); // Fade out
                    setTimeout(() => {
                        toast.style.display = 'none'; // Slide down and hide
                    }, 500); // Match this to the transition duration
                }, 5000); // Toast display duration
            }, 100); // Delay before showing
        }
    </script>
</body>
</html>
