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
?>
<?php
  if(count($_GET) && isset($_GET['followfavoritsport'])){
    user :: set_topic_by_email($_SESSION['email'], 1, "favoritsport");
    header("Location:explorePage.php");
  }
  if(count($_GET) && isset($_GET['unfollowfavoritsport'])){
    user :: set_topic_by_email($_SESSION['email'], 0, "favoritsport");
    header("Location:explorePage.php");
  }
  if(count($_GET) && isset($_GET['followfavoritmakeup'])){
    user :: set_topic_by_email($_SESSION['email'], 1, "favoritmakeup");
    header("Location:explorePage.php");
  }
  if(count($_GET) && isset($_GET['unfollowfavoritmakeup'])){
    user :: set_topic_by_email($_SESSION['email'], 0, "favoritmakeup");
    header("Location:explorePage.php");
  }
  if(count($_GET) && isset($_GET['followfavoritkpop'])){
    user :: set_topic_by_email($_SESSION['email'], 1, "favoritkpop");
    header("Location:explorePage.php");
  }
  if(count($_GET) && isset($_GET['unfollowfavoritkpop'])){
    user :: set_topic_by_email($_SESSION['email'], 0, "favoritkpop");
    header("Location:explorePage.php");
  }
  if(count($_GET) && isset($_GET['followfavorithairstyle'])){
    user :: set_topic_by_email($_SESSION['email'], 1, "favorithairstyle");
    header("Location:explorePage.php");
  }
  if(count($_GET) && isset($_GET['unfollowfavorithairstyle'])){
    user :: set_topic_by_email($_SESSION['email'], 0, "favorithairstyle");
    header("Location:explorePage.php");
  }
  if(count($_GET) && isset($_GET['followfavoritdrawing'])){
    user :: set_topic_by_email($_SESSION['email'], 1, "favoritdrawing");
    header("Location:explorePage.php");
  }
  if(count($_GET) && isset($_GET['unfollowfavoritdrawing'])){
    user :: set_topic_by_email($_SESSION['email'], 0, "favoritdrawing");
    header("Location:explorePage.php");
  }
  if(count($_GET) && isset($_GET['followfavoritbaking'])){
    user :: set_topic_by_email($_SESSION['email'], 1, "favoritbaking");
    header("Location:explorePage.php");
  }
  if(count($_GET) && isset($_GET['unfollowfavoritbaking'])){
    user :: set_topic_by_email($_SESSION['email'], 0, "favoritbaking");
    header("Location:explorePage.php");
  }
  if(count($_GET) && isset($_GET['followfavoritcooking'])){
    user :: set_topic_by_email($_SESSION['email'], 1, "favoritcooking");
    header("Location:explorePage.php");
  }
  if(count($_GET) && isset($_GET['unfollowfavoritcooking'])){
    user :: set_topic_by_email($_SESSION['email'], 0, "favoritcooking");
    header("Location:explorePage.php");
  }
  if(count($_GET) && isset($_GET['followfavoritcar'])){
    user :: set_topic_by_email($_SESSION['email'], 1, "favoritcar");
    header("Location:explorePage.php");
  }
  if(count($_GET) && isset($_GET['unfollowfavoritcar'])){
    user :: set_topic_by_email($_SESSION['email'], 0, "favoritcar");
    header("Location:explorePage.php");
  }
  if(count($_GET) && isset($_GET['followfavoritgame'])){
    user :: set_topic_by_email($_SESSION['email'], 1, "favoritgame");
    header("Location:explorePage.php");
  }
  if(count($_GET) && isset($_GET['unfollowfavoritgame'])){
    user :: set_topic_by_email($_SESSION['email'], 0, "favoritgame");
    header("Location:explorePage.php");
  }
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
        flex: 25%;
        margin:10px;
      }
      .card:hover{
        box-shadow: 3px 3px 5px black;
      }

      .card-title {
        margin-top:3cm;
        text-align:center;
        font-size: 70px; /* Adjust the font size as needed */
        color: white; /* Text color */
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
        <b class="logo" id="lOGOText">LOGO</b>
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
      <img
        id="profile-atas"
        class="profile-circle-icon-512x512-zx1"
        alt=""
        src="assets\profileicon.png"
      /> <!--profile atas-->
      <div id="list-topik">
        <div class="card text-bg-dark" id="sport">
          <img src="assets\sport.png" class="card-img" alt="...">
          <div class="card-img-overlay" style="text-align:center";>
            <h5 class="card-title">SPORT</h5>
            <form action="explorePage.php" method="GET">
              <?php 
                  if($_SESSION['favoritsport'] == 0){
                    echo "<button id='followfavoritsport' name='followfavoritsport' style='background-color:rgb(219, 7, 24); border:none; color:#f2f2f2;border-radius:10px;'>Follow +</button>";
                  }
                  else{
                    echo "<button id='unfollowfavoritsport' name='unfollowfavoritsport' style='background-color:rgb(207, 207, 207); border:none; color:black;border-radius:10px;'>Following...</button>";
                  }
              ?>
            </form>
          </div>
        </div>
        <div class="card text-bg-dark" id="makeup">
          <img src="assets\makeup.png" class="card-img" alt="...">
          <div class="card-img-overlay" style="text-align:center">
            <h5 class="card-title">MAKE UP</h5>
            <form action="explorePage.php" method="GET">
              <?php 
                  if($_SESSION['favoritmakeup'] == 0){
                    echo "<button id ='followfavoritmakeup' name='followfavoritmakeup' style='background-color:rgb(219, 7, 24); border:none; color:#f2f2f2;border-radius:10px;'>Follow +</button>";
                  }
                  else{
                    echo "<button id='unfollowfavoritmakeup' name='unfollowfavoritmakeup' style='background-color:rgb(207, 207, 207); border:none; color:black;border-radius:10px;'>Following...</button>";
                  }
              ?>
            </form>
          </div>
        </div>
        <div class="card text-bg-dark" id="kpop">
          <img src="assets\kpop.png" class="card-img" alt="...">
          <div class="card-img-overlay" style="text-align:center">
            <h5 class="card-title">K-POP</h5>
            <form action="explorePage.php" method="GET">
              <?php 
                  if($_SESSION['favoritkpop'] == 0){
                    echo "<button id='followfavoritkpop' name='followfavoritkpop' style='background-color:rgb(219, 7, 24); border:none; color:#f2f2f2;border-radius:10px;'>Follow +</button>";
                  }
                  else{
                    echo "<button id='unfollowfavoritkpop' name='unfollowfavoritkpop' style='background-color:rgb(207, 207, 207); border:none; color:black;border-radius:10px;'>Following...</button>";
                  }
              ?>
            </form>
          </div>
        </div>
        <div class="card text-bg-dark" id=hairstyle>
          <img src="assets\hairstyle.png" class="card-img" alt="...">
          <div class="card-img-overlay" style="text-align:center">
            <h5 class="card-title">HAIRSTYLE</h5>
            <form action="explorePage.php" method="GET">
              <?php 
                  if($_SESSION['favorithairstyle'] == 0){
                    echo "<button id='followfavorithairstyle' name='followfavorithairstyle' style='background-color:rgb(219, 7, 24); border:none; color:#f2f2f2;border-radius:10px;'>Follow +</button>";
                  }
                  else{
                    echo "<button id='unfollowfavorithairstyle' name='unfollowfavorithairstyle' style='background-color:rgb(207, 207, 207); border:none; color:black;border-radius:10px;'>Following...</button>";
                  }
              ?>
            </form>
          </div>
        </div>
        <div class="card text-bg-dark" id="drawing">
          <img src="assets\drawing.png" class="card-img" alt="...">
          <div class="card-img-overlay" style="text-align:center">
            <h5 class="card-title">DRAWING</h5>
            <form action="explorePage.php" method="GET">
              <?php 
                  if($_SESSION['favoritdrawing'] == 0){
                    echo "<button id='followfavoritdrawing' name='followfavoritdrawing' style='background-color:rgb(219, 7, 24); border:none; color:#f2f2f2;border-radius:10px;'>Follow +</button>";
                  }
                  else{
                    echo "<button id='unfollowfavoritdrawing' name='unfollowfavoritdrawing' style='background-color:rgb(207, 207, 207); border:none; color:black;border-radius:10px;'>Following...</button>";
                  }
              ?>
            </form>
          </div>
        </div>
        <div class="card text-bg-dark" id="baking">
          <img src="assets\baking.png" class="card-img" alt="...">
          <div class="card-img-overlay" style="text-align:center">
            <h5 class="card-title">BAKING</h5>
            <form action="explorePage.php" method="GET">
              <?php 
                  if($_SESSION['favoritbaking'] == 0){
                    echo "<button id='followfavoritbaking' name='followfavoritbaking' style='background-color:rgb(219, 7, 24); border:none; color:#f2f2f2;border-radius:10px;'>Follow +</button>";
                  }
                  else{
                    echo "<button id='unfollowfavoritbaking' name='unfollowfavoritbaking' style='background-color:rgb(207, 207, 207); border:none; color:black;border-radius:10px;'>Following...</button>";
                  }
              ?>
            </form>
          </div>
        </div>
        <div class="card text-bg-dark" id="cooking">
          <img src="assets\cooking.png" class="card-img" alt="...">
          <div class="card-img-overlay" style="text-align:center">
            <h5 class="card-title">COOKING</h5>
            <form action="explorePage.php" method="GET">
              <?php 
                  if($_SESSION['favoritcooking'] == 0){
                    echo "<button id='followfavoritcooking' name='followfavoritcooking' style='background-color:rgb(219, 7, 24); border:none; color:#f2f2f2;border-radius:10px;'>Follow +</button>";
                  }
                  else{
                    echo "<button id='unfollowfavoritcooking' name='unfollowfavoritcooking' style='background-color:rgb(207, 207, 207); border:none; color:black;border-radius:10px;'>Following...</button>";
                  }
              ?>
            </form>
          </div>
        </div>
        <div class="card text-bg-dark" id="car">
          <img src="assets\car.png" class="card-img" alt="...">
          <div class="card-img-overlay" style="text-align:center">
            <h5 class="card-title">CAR</h5>
            <form action="explorePage.php" method="GET">
              <?php 
                  if($_SESSION['favoritcar'] == 0){
                    echo "<button id='followfavoritcar' name='followfavoritcar' style='background-color:rgb(219, 7, 24); border:none; color:#f2f2f2;border-radius:10px;'>Follow +</button>";
                  }
                  else{
                    echo "<button id='unfollowfavoritcar' name='unfollowfavoritcar' style='background-color:rgb(207, 207, 207); border:none; color:black;border-radius:10px;'>Following...</button>";
                  }
              ?>
            </form>
          </div>
        </div>
        <div class="card text-bg-dark" id="game">
          <img src="assets\games.png" class="card-img" alt="...">
          <div class="card-img-overlay" style="text-align:center">
            <h5 class="card-title">GAME</h5>
            <form action="explorePage.php" method="GET">
              <?php 
                  if($_SESSION['favoritgame'] == 0){
                    echo "<button id='followfavoritgame' name='followfavoritgame' style='background-color:rgb(219, 7, 24); border:none; color:#f2f2f2;border-radius:10px;'>Follow +</button>";
                  }
                  else{
                    echo "<button id='unfollowfavoritgame' name='unfollowfavoritgame' style='background-color:rgb(207, 207, 207); border:none; color:black;border-radius:10px;'>Following...</button>";
                  }
              ?>
            </form>
          </div>
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