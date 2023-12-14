<?php
  session_start();
  $currentPage = basename($_SERVER['PHP_SELF']);
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link rel="stylesheet" href="globalstylesProfilePage.css" />
    <link rel="stylesheet" href="stylesProfilePage.css" />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Inter:wght@500;600;700&display=swap"
    />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
    <div class="profile" style="background-color:red"> <!--keseluruhan-->
      <div class="container-fluid" id="profile-child"> <!--navbar-->
        <b class="logo" id="lOGOText">LOGO</b>
        <div class="home" id="homeText" <?php if ($currentPage == 'homePage.php') echo 'style="border-radius: 20%; background-color: #545454; color: #ffffff;"'; ?>>Home</div>
        <div class="explore" id="exploreText" <?php if ($currentPage == 'explorePage.php') echo 'style="border-radius: 20%; background-color: #545454; color: #ffffff;"'; ?>>Explore</div>
        <div class="profile-item"></div>
        <input type="text" class="rectangle-div" placeholder="Search..."  id="search"></input>
        <img
        class="heart-svgrepo-com-2-1"
        alt=""
        src="assets\hati.png"
        id="heartSvgrepoCom21"
        />
        <div class="my-favourite" id="myFavouriteText" <?php if ($currentPage == 'favouritePage.php') echo 'style="border-radius: 20%; background-color: #545454; color: #ffffff;"'; ?>>My Favourite</div>
      </div>
      <img class="layer-1-icon" alt="" src="assets\Layer_1.png" /> <!--tombol add post-->
      <img
        id="profile-atas"
        class="profile-circle-icon-512x512-zx1"
        alt=""
        src="assets\profileicon.png"
      /> <!--profile atas-->
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
          // Please sync "MY FAVOURITE" to the project
        });
      }
      
      var lOGOText = document.getElementById("lOGOText");
      if (lOGOText) {
        lOGOText.addEventListener("click", (e) => {
          // Please sync "HOME" to the project
        });
      }
      
      var heartSvgrepoCom21 = document.getElementById("heartSvgrepoCom21");
      if (heartSvgrepoCom21) {
        heartSvgrepoCom21.addEventListener("click", (e) => {
          // Please sync "MY FAVOURITE" to the project
        });
      }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>