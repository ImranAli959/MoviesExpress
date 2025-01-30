<?php

session_start();

include('../conn.php');

if((empty($_SESSION["adminLogin"])) || ($_SESSION["adminLogin"]=="")){

    header("Location: login.php");
    
}

if(isset($_POST['logout'])){
    session_destroy();
    header("Location: login.php");
}


if (isset($_POST["submit"])) {
    // Get form data
    $name = $_POST['name'];
    $time = $_POST['time'];
    $price = $_POST['price'];
    
    // Handle image upload
    $image = $_FILES['image']['name'];
    $target_dir = "../img/";
    $target_file = $target_dir . basename($image);
    
    // Check if image file is a valid image
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $check = getimagesize($_FILES['image']['tmp_name']);
    
    if ($check !== false) {
        // Move uploaded file to the server
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            // Insert data into database
            $insertQuery = "INSERT INTO movies (name, image, timing, price) VALUES ('$name', '$image', '$time', '$price')";
            if (!mysqli_query($conn, $insertQuery)) {
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "File is not an image.";
    }
}


?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin-Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .displayImage{
            height: 100px;
            width: auto;
        }
    </style>
  </head>
  <body>
    <div class="fluid-container">
        <div class="container">
            <h1>All Movies</h1>

            <form action="" method="post" class="logoutForm">
                <input type="submit" value="Logout" name="logout" class="logoutBtn">
            </form>

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Add Movie
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Movie</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" id="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="time" class="form-label">Timing</label>
                            <input type="text" name="time" class="form-control" id="time" required>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="text" name="price" class="form-control" id="price" required>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" name="image" class="form-control" id="image" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
                </div>
            </div>
            </div>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Timing</th>
                        <th scope="col">Price</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    
                        $movieQRY = mysqli_query($conn, "SELECT * FROM `movies`");
                        $i = 1;

                        while($row = mysqli_fetch_assoc($movieQRY)){
                            ?>

                                <tr>
                                    <th scope="row"><?php echo $i; $i++?></th>
                                    <td><img src="../img/<?php echo $row['image']?>" alt="" class="displayImage"></td>
                                    <td><?php echo $row['name']?></td>
                                    <td><?php echo $row['timing']?></td>
                                    <td><?php echo $row['price']?></td>
                                    <td><a href="delete.php?id=<?php echo $row['id']?>" onclick="return confirm('Are you sure you want to delete this movie?');"><button>Delete</button></a></td>
                                </tr>

                            <?php
                        }

                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>