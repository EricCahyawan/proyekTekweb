<?php
include 'includes/connect.php';


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
              <a class="nav-link" href="mainpage.php">Home</a>
            </li>

            <li class="nav-item">
              <a class="nav-link active" href="explorePage.php">Explore</a>
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
          <img src="assets\kpopp.jpg" class="card-img-top card-img-bottom" width="100%" style="height:340px">
          <div class="card-img-overlay" style="text-align:center";>
            <h5 class="card-title">K-POP</h5>
          </div>
        </div>
      </div>
    </div>
  </div>

      <div class="content">
        <div class="content-web my-4">
          <div class="row">

            <?php
            $postpulse = new PostPulse();
            $postpulse->tampil_kpop($connect);
            
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
