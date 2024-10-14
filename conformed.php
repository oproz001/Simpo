<?php

    include "database/connn.php";

    $sql = "SELECT * FROM registred ORDER BY ";
    $infos = mysqli_query($conn,$sql);

    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered</title>
    <style>
        html {
            font-size: 24px;
        }
        body {
            background-color: #333;
            color: whitesmoke;
        }
    </style>
</head>
<body>
    <h4>The Following Are The Registred Guys And thier Properties</h4>
    <div>
        <table>
            <thead>
                <tr>
                    <th>S/N</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Course</th>
                    <th>Gender</th>
                    <th>Phone Number</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; foreach($infos as $info){?>
                    <tr>
                <td><?php echo $i++; ?></td>
                <td><?php echo $info['fullname'] ?></td>
                <td><?php echo $info['email'] ?></td>
                <td><?php echo $info['course'] ?></td>
                <td><?php echo $info['gender'] ?></td>
                <td><?php echo $info['phoneno'] ?></td>
                <td>
                    <button>View</button>
                    <button>Add</button>
                </td>
                </tr>
           <?php }?>
            </tbody>
        </table>
    </div>
</body>
</html>