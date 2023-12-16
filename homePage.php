<?php

include 'includes/connect.php';

// if (empty($session_login))
//     header('location: login.php');

if (isset($_POST['upload'])) {
    $id_topic = $_POST['id_topic'];
    $foto = $_FILES['image']['name'];
    $lokasifoto = $_FILES['image']['tmp_name'];
    move_uploaded_file($lokasifoto, "posts/" . $foto);

    $insert_post = $postpulse->insert_post([
        'id_topic' => $id_topic,
        'foto' => $foto
    ]);


    if ($insert_post) {
        header('location: mainpage.php?msg=posted');
        echo '<script>
            setTimeout(function() {
                alert("Your message here");
            }, 2000);
          </script>';
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POSTPULSE</title>

    <link rel="stylesheet" href="style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">LOGO</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="explorePage.php">Explore</a>
                    </li>

                    <input type="text" class="rectangle-div" placeholder="Search..."></input>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="#"><img src="assets\hati.png"/> My Favourite</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#"><img src="assets\profileicon (3).png" style="size: 20px"/></a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    <!-- modal add post -->
    <div class="modal fade" id="modalAddPost" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">ADD POST</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body" id="modal-body">
                    <form class="my-1" method="post" enctype="multipart/form-data">

                        <div class="mb-3">
                            <label for="topic-dropdown" class="form-label">Choose Topic</label>
                            <select name="id_topic" class="form-control" required>
                                <option value="">Select Topic</option>
                                <?php
                                $postpulse = new PostPulse();
                                $postpulse->tampil_topic($connect);
                                ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="add-image" class="form-label">Choose Image</label>
                                <input type="file" name="image" class="form-control" required>
                                <div class="my-5 footer">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="position-fixed">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button class="btn btn-success" name="upload" value="upload">Upload</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </label>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- show posts -->
    <div class="content">
        <div class="content-web my-4">

            <?= isset($msg) ? '<div class="alert alert-danger">' . $msg . '</div>' : '' ?>
            <?= (isset($_GET['msg']) && $_GET['msg'] == 'posted') ? '<div class="alert alert-success">Posted!</div>' : '' ?>
            
            <div class="row">
                <?php
                $postpulse = new PostPulse();
                $postpulse->tampil_post($connect);
                ?>
            </div>

        </div>
    </div>
    
    <!-- button add post -->
    <div class="row">
        <div class="col-md-12">
            <div class="position-fixed bottom-0 end-0 tombol-add">
                <div class="d-grid gap-2">
                    <button class="btn" data-bs-toggle="modal" data-bs-target="#modalAddPost" name="addpost">                          
                    <img class="layer-1-icon" src="assets\Layer_1.png"/>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
