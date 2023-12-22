<?php
session_start();
include 'includes/connect.php';
require 'classes/user.php';
$currentPage = basename($_SERVER['PHP_SELF']);


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
        header('location: homePage.php?msg=posted');
        exit;
    }
}

if (isset($_POST['simpankomentar'])) {
    $id_post = $_POST['id_post'];
    $username = $_POST['username'];
    $komentar = $_POST['komentar'];

    $insert_komentar = $postpulse->insert_komentar([
        'id_post' => $id_post,
        'username' => $username,
        'komentar' => $komentar,
    ]);

    if ($insert_komentar) {
        header('location: homePage.php?msg=komentar');
    }
}

if (isset($_POST['simpankomentarbalasan'])) {
    $idkomentar = $_POST['idkomentar'];
    $username = $_POST['username'];
    $komentar = $_POST['komentar'];
    $insert_komentarbalasan = $postpulse->insert_komentarbalasan([
        'idkomentar' => $idkomentar,
        'username' => $username,
        'komentar' => $komentar,
    ]);

    if ($insert_komentarbalasan) {
        header('location: homePage.php?msg=balasan');
    }
}
?>
<?php
    $result = user::get_user_by_email($_SESSION['email']);
    $_SESSION['src'] = $result['src'];
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
    <style>
        .profile-circle-icon-512x512-zx1 {
        width: 69px;
        height: 69px;    
        border-radius: 50%;
        overflow: hidden;
        object-fit: cover;
      }
      #home-text{
        position:absolute;
        top:0.5cm;
        left:4cm;
      }
      #explore-text{
        position:absolute;
        top:0.5cm;
        left:7cm;
      }
      #search{
        position:absolute;
        top:0.5cm;
        left:11cm;
        height:1.6cm
      }
      #favourite-text{
        position:absolute;
        top:0.5cm;
        left:29.7cm;
      }
      #profile{
        position:absolute;
        top:0.1cm;
        left:35cm;
      }

    </style>
</head>

<body>

    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid" style="height:2cm">
           

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a id="home-text" class="nav-link active" href="homePage.php" <?php if ($currentPage == 'homePage.php') echo 'style="border-radius: 20%; background-color: #545454; color: #ffffff;"'; ?>>Home</a>
                    </li>

                    <li class="nav-item">
                        <a id="explore-text"class="nav-link" href="explorePage.php" <?php if ($currentPage == 'explorePage.php') echo 'style="border-radius: 20%; background-color: #545454; color: #ffffff;"'; ?>>Explore</a>
                    </li>

                    <input id="search" type="text" class="rectangle-div" placeholder="Search..."></input>
                    
                    <li class="nav-item">
                        <a id="favourite-text" class="nav-link" href="favouritePage.php" <?php if ($currentPage == 'favouritePage.php') echo 'style="border-radius: 20%; background-color: #545454; color: #ffffff;"'; ?>><img src="assets\hati.png"/> My Favourite</a>
                    </li>

                    <li class="nav-item">
                        <a id= "profile" class="nav-link" href="profilePage.php"><?php
                            $src = isset($_SESSION['src']) ? $_SESSION['src'] : 'assets\profileicon.png';
                            echo "<img
                                    id='profile-atas'
                                    class='profile-circle-icon-512x512-zx1'
                                    alt=''
                                    src='{$src}'
                                    />"
                            ?>  <!--profile atas-->
                        </a>
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
            <?= (isset($_GET['msg']) && $_GET['msg'] == 'komentar') ? '<div class="alert alert-success">Komentar Berhasil Di Kirim!</div>' : '' ?>
            <?= (isset($_GET['msg']) && $_GET['msg'] == 'balasan') ? '<div class="alert alert-success">Balasan Berhasil Di Kirim!</div>' : '' ?>
            
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
                    <img class="layer-1-icon" src="assets\plus.png"/>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
