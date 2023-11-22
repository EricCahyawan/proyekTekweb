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
    <div class="profile"> <!--keseluruhan-->
      <div class="container-fluid" id="profile-child"> <!--navbar-->
        <b class="logo" id="lOGOText">LOGO</b>
        <div class="home" id="homeText">Home</div>
        <div class="explore" id="exploreText">Explore</div>
        <div class="profile-item"></div>
        <input type="text" class="rectangle-div" placeholder="Search..."></input>
        <img
        class="heart-svgrepo-com-2-1"
        alt=""
        src="assets\hati.png"
        id="heartSvgrepoCom21"
        />
        <div class="my-favourite" id="myFavouriteText">My Favourite</div>
      </div>
      <div class="ellipse-div"> </div>     
      <div class="logout-wrapper">
        <div class="logout">Logout</div>
      </div>
      <div class="posts">Posts</div>
      <div class="emailemailcom">email@email.com</div>
      <div class="username">username</div>
      <img
        class="profile-circle-icon-512x512-zx"
        alt=""
        src="assets\profileicon.png"
      />
      <div class="line-div"></div>
      <img class="layer-1-icon" alt="" src="assets\Layer_1.png" /> <!--tombol add post-->
      <img
        class="profile-circle-icon-512x512-zx1"
        alt=""
        src="assets\profileicon.png"
      />
    </div>
    <script>
      var exploreText = document.getElementById("exploreText");
      if (exploreText) {
        exploreText.addEventListener("click", function (e) {
          window.alert("Clicked!");
        });
      }
      
      var homeText = document.getElementById("homeText");
      if (homeText) {
        homeText.addEventListener("click", function (e) {
          // Please sync "HOME" to the project
        });
      }
      
      var myFavouriteText = document.getElementById("myFavouriteText");
      if (myFavouriteText) {
        myFavouriteText.addEventListener("click", function (e) {
          // Please sync "MY FAVOURITE" to the project
        });
      }
      
      var lOGOText = document.getElementById("lOGOText");
      if (lOGOText) {
        lOGOText.addEventListener("click", function (e) {
          // Please sync "HOME" to the project
        });
      }
      
      var heartSvgrepoCom21 = document.getElementById("heartSvgrepoCom21");
      if (heartSvgrepoCom21) {
        heartSvgrepoCom21.addEventListener("click", function (e) {
          // Please sync "MY FAVOURITE" to the project
        });
      }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>
