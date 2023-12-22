<?php
include 'includes/connect.php';
require 'classes/user.php';

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
      header('location: hairstyle.php?msg=komentar');
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
      header('location: hairstyle.php?msg=balasan');
  }
}

  ?>
  <?php
    session_start();
    $result = user::get_user_by_email($_SESSION['email']);
    $_SESSION['src'] = $result['src'];
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Inter:wght@500;600;700&display=swap"
    />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="stylegithub.css"/>
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
              <a id="home-text" class="nav-link" href="homePage.php">Home</a>
            </li>

            <li class="nav-item">
              <a id="explore-text" class="nav-link active" href="explorePage.php">Explore</a>
            </li>

            <input type="text" class="rectangle-div" id="search" placeholder="Search..."></input>
                    
            <li class="nav-item">
              <a id="favourite-text" class="nav-link" href="#"><img src="assets\hati.png"/> My Favourite</a>
            </li>

            <li class="nav-item">
              <a id= "profile" class="nav-link" href="#"><?php
                            $src = isset($_SESSION['src']) ? $_SESSION['src'] : 'assets\profileicon.png';
                            echo "<img
                                    id='profile-atas'
                                    class='profile-circle-icon-512x512-zx1'
                                    alt=''
                                    src='{$src}'
                                    />"
                            ?>  <!--profile atas--></a>
            </li>

          </ul>
        </div>
      </div>
    </nav>
     
    <!-- back button -->
    <div class="position-absolute">
      <div class="position-absolute top-0 start-0 back-button">
        <div class="d-grid gap-2">
              <a href="explorePage.php"><img src="assets\backk.png"/></a>
        </div>  
      </div>
    </div>

    <!-- content -->
  <div class="container">
    <div class="row">
      <div class="col-md-6 offset-md-3 text-center mt-3">
        <div class="card">
          <img src="assets\hairstylee.png" class="card-img-top card-img-bottom" width="100%" style="height:340px">
          <div class="card-img-overlay" style="text-align:center";>
            <h5 class="card-title">HAIRSTYLE</h5>
          </div>
        </div>
      </div>
    </div>
  </div>

      <div class="content">
        <div class="content-web my-4">
            <?= (isset($_GET['msg']) && $_GET['msg'] == 'komentar') ? '<div class="alert alert-success">Komentar Berhasil Di Kirim!</div>' : '' ?>
            <?= (isset($_GET['msg']) && $_GET['msg'] == 'balasan') ? '<div class="alert alert-success">Balasan Berhasil Di Kirim!</div>' : '' ?>
            
          <div class="row">

            <?php
            $postpulse = new PostPulse();
            $postpulse->tampil_hairstyle($connect);
            
            ?>

          </div>
        </div>
      </div>
  

    <script>
      var profileatas = document.getElementById("profile-atas");
      profileatas.addEventListener("click", (e) => {
        window.location.href = "profilePage.php";
      });

      var exploreText = document.getElementById("exploreText");
      exploreText.addEventListener("click", (e) => {
        window.location.href = "explorePage.php";});
      
      
      var homeText = document.getElementById("homeText");
      homeText.addEventListener("click", (e) => {
      window.alert("Clicked!");});
 
      
      var myFavouriteText = document.getElementById("myFavouriteText");
      if (myFavouriteText) {
        myFavouriteText.addEventListener("click", (e) => {
          window.location.href="favouritePage.php";
        });
      }
      
      var heartSvgrepoCom21 = document.getElementById("heartSvgrepoCom21");
      if (heartSvgrepoCom21) {
        heartSvgrepoCom21.addEventListener("click", (e) => {
          window.location.href="favouritePage.php";
        });
      }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>
