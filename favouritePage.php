<?php
  session_start();
  require "classes/user.php";
  $currentPage = basename($_SERVER['PHP_SELF']);
  $result = user :: get_user_by_email($_SESSION['email']);
  $_SESSION['favoritsport'] = $result['favoritsport'];
  $_SESSION['favoritmakeup'] = $result['favoritmakeup'];
  $_SESSION['favoritkpop'] = $result['favoritkpop'];
  $_SESSION['favorithairstyle'] = $result['favorithairstyle'];
  $_SESSION['favoritdrawing'] = $result['favoritdrawing'];
  $_SESSION['favoritbaking'] = $result['favoritbaking'];
  $_SESSION['favoritcooking'] = $result['favoritcooking'];
  $_SESSION['favoritcar'] = $result['favoritcar'];
  $_SESSION['favoritgame'] = $result['favoritgame'];
  $result = user::get_user_by_email($_SESSION['email']);
  $_SESSION['src'] = $result['src'];
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
    <style>
      #list-topik{
        background-color:white;
        padding:1.5cm;
        margin-top: 2cm;
        margin-left:1cm;
        margin-right:1cm;
        height: auto;
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        justify-content: center;
      }
      .card{
        width:11.3cm;
        margin:10px;
      }
      .card:hover{
        box-shadow: 3px 3px 5px black;
      }

      .card-title {
        text-align:center;
        font-size: 70px; /* Adjust the font size as needed */
        color: white; /* Text color */
        margin-top: 29%;
      }
      #profile-child{
        position: fixed;
        background-color: #d9d9d9;
        width: 14500px;
        height: 119px;
        top: 0;
        z-index: 1;
      }
      .fit-image {
        object-fit: cover;
        width: 100%;
        height: 100%;
}
      .profile-item {
        position: absolute;
        top: -3px;
        right: 0;
        left: 0;
        background-color: #d9d9d9;
        width: 14500px;
        height: 119px;
      }
      .profile-circle-icon-512x512-zx1{
        border-radius: 50%;
        overflow: hidden;
        object-fit: cover;
      }
      .profile-item {
        top: 15px;
        left: 1321px;
        border-radius: 44px;
        background-color: #9b9696;
        width: 94px;
        height: 93px;
      }
      .profile-inner,
      .rectangle-div {
        position: absolute;
        top: 24px;
        height: 70px;
      }
      .profile-inner {
        left: 26px;
        border-radius: 50%;
        width: 70px;
        object-fit: cover;
      }
      .rectangle-div {
        left: 382px;
        border-radius: 26px;
        background-color: #f6f6f6;
        width: 665px;
      }
      
      .explore,
      .search {
        position: absolute;
        top: 45px;
      }
      .search {
        left: 451px;
        font-weight: 500;
        color: var(--color-gray);
      }
      .explore {
        left: 261px;
        font-weight: 600;
      }  
      .home,
      .my-favourite{
        position: absolute;
        font-weight: 600;
      }
      .home,
      .my-favourite {
        top: 45px;
        left: 140px;
      }
      .my-favourite {
        left: 1152px;
      }
      .logo {
        position: absolute;
        top: 50px;
        left: 38px;
        font-size: 16px;
        color: var(--color-gray);
      }
      .heart-svgrepo-com-2-1 {
        position: absolute;
        top: 42px;
        left: 1109px;
        width: 35px;
        height: 35px;
        overflow: hidden;
        object-fit: cover;
      }
      
      .layer-1-icon {
        position: fixed;
        top: 16cm;
        right: 4cm;
        overflow: hidden;
        z-index: 1;
      }
      
      .profile {
        position: relative;
        background-color: #fff;
        width: 100%;
        height: auto;
        font-size: var(--font-size-5xl);
        color: var(--color-dimgray);
        font-family: var(--font-inter);
      
      }
      #homeText:hover{
        cursor:pointer;
      }
      #exploreText:hover{
        cursor:pointer;
      }
      #myFavouriteText:hover{
        cursor:pointer;
      }
    </style>
  </head>
  <body>
    <div class="profile"> <!--keseluruhan-->
      <div class="container-fluid" id="profile-child"> <!--navbar-->
        <div class="home" id="homeText" <?php if ($currentPage == 'homePage.php') echo 'style="border-radius: 20%; background-color: #545454; color: #ffffff;"'; ?>>Home</div>
        <div class="explore" id="exploreText" <?php if ($currentPage == 'explorePage.php') echo 'style="border-radius: 20%; background-color: #545454; color: #ffffff;"'; ?>>Explore</div>
        <div class="profile-item" <?php if($currentPage != 'profilePage.php') echo "style='display:none;'"?>></div>
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
      <?php
          $src = isset($_SESSION['src']) ? $_SESSION['src'] : 'assets\profileicon.png';
          echo "<img
                  id='profile-atas'
                  class='profile-circle-icon-512x512-zx1'
                  alt=''
                  src='{$src}'
                />"
        ?>  <!--profile atas-->
      <div id="list-topik">
        <?php
            if($_SESSION['favoritsport'] == 1){
                echo '
                    <div id="sport" class="card text-bg-dark">
                        <img src="assets\sport.png" class="card-img" alt="...">
                        <div class="card-img-overlay" style="text-align:center";>
                            <h5 class="card-title">SPORT</h5>
                        </div>
                    </div>
                ';
            }
            if($_SESSION['favoritmakeup'] == 1){
                echo '
                    <div id="makeup" class="card text-bg-dark">
                        <img src="assets\makeup.png" class="card-img" alt="...">
                        <div class="card-img-overlay" style="text-align:center">
                            <h5 class="card-title">MAKE UP</h5>
                        </div>
                    </div>
                ';
            }
            if($_SESSION['favoritkpop'] == 1){
                echo '
                    <div id="kpop" class="card text-bg-dark">
                        <img src="assets\kpop.png" class="card-img" alt="...">
                        <div class="card-img-overlay" style="text-align:center">
                            <h5 class="card-title">K-POP</h5>
                        </div>
                    </div>
                ';
            }
            if($_SESSION['favorithairstyle'] == 1){
                echo '
                    <div id="hairstyle" class="card text-bg-dark">
                        <img src="assets\hairstyle.png" class="card-img" alt="...">
                        <div class="card-img-overlay" style="text-align:center">
                            <h5 class="card-title">HAIRSTYLE</h5>
                        </div>
                    </div>
                ';
            }
            if($_SESSION['favoritdrawing'] == 1){
                echo '
                    <div id="drawing" class="card text-bg-dark">
                        <img src="assets\drawing.png" class="card-img" alt="...">
                        <div class="card-img-overlay" style="text-align:center">
                            <h5 class="card-title">DRAWING</h5>
                        </div>
                    </div>
                ';
            }
            if($_SESSION['favoritbaking'] == 1){
                echo '
                    <div id="baking" class="card text-bg-dark">
                        <img src="assets\baking.png" class="card-img" alt="...">
                        <div class="card-img-overlay" style="text-align:center">
                            <h5 class="card-title">BAKING</h5>
                        </div>
                    </div>
                ';
            }
            if($_SESSION['favoritcooking'] == 1){
                echo '
                    <div id="cooking" class="card text-bg-dark">
                        <img src="assets\cooking.png" class="card-img" alt="...">
                        <div class="card-img-overlay" style="text-align:center">
                            <h5 class="card-title">COOKING</h5>
                        </div>
                    </div>
                ';
            }
            if($_SESSION['favoritcar'] == 1){
                echo '
                    <div id="car" class="card text-bg-dark">
                        <img src="assets\car.png" class="card-img" alt="...">
                        <div class="card-img-overlay" style="text-align:center">
                            <h5 class="card-title">CAR</h5>
                        </div>
                    </div>
                ';
            }
            if($_SESSION['favoritgame'] == 1){
                echo '
                    <div id="game" class="card text-bg-dark">
                        <img src="assets\games.png" class="card-img" alt="...">
                        <div class="card-img-overlay" style="text-align:center">
                            <h5 class="card-title">GAME</h5>
                        </div>
                    </div>
                ';
            }
        ?>
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
      window.location.href= "homePage.php"});
 
      
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
      let sport = document.querySelector("#sport");
      let makeup = document.querySelector("#makeup");
      let kpop = document.querySelector("#kpop");
      let hairstyle = document.querySelector("#hairstyle");
      let drawing = document.querySelector("#drawing");
      let baking = document.querySelector("#baking");
      let cooking = document.querySelector("#cooking");
      let car = document.querySelector("#car");
      let game = document.querySelector("#game");
      if(sport){
        sport.addEventListener("click", () => {
          window.location.href="sport.php";
        });
      }
      if(makeup){
        makeup.addEventListener("click", () => {
          window.location.href="makeup.php";
        });
      }
      if(kpop){
        kpop.addEventListener("click", () => {
          window.location.href="kpop.php";
        });
      }
      if(hairstyle){
        hairstyle.addEventListener("click", () => {
          window.location.href="hairstyle.php";
        });
      }
      if(drawing){
        drawing.addEventListener("click", () => {
          window.location.href="drawing.php";
        });
      }
      if(baking){
        baking.addEventListener("click", () => {
          window.location.href="baking.php";
        });
      }
      if(cooking){
        cooking.addEventListener("click", () => {
          window.location.href="cooking.php";
        });
      }
      if(car){
        car.addEventListener("click", () => {
          window.location.href="car.php";
        });
      }
      if(game){
        game.addEventListener("click", () => {
          window.location.href="game.php";
        });
      }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>