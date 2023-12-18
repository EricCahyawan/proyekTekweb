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
    <link rel="stylesheet" href="stylegithub.css"/>
    
    <style>
      .profile-circle-icon-512x512-zx1{
        border-radius: 50%;
        overflow: hidden;
        object-fit: cover;
      }
    </style>
  </head>
  <body>
    
    <!-- navbar -->
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
      <form action="profilePage.php" method="post">
        <div class="logout-wrapper">
          <input type="submit" value="Logout" class="logout" name="logout">
        </div>
      </form>   
      <div class="posts">Posts</div>
      <div id="username-email-container">
        <div class="username"><?php echo $_SESSION['username'];?></div>
        <div class="emailemailcom"><?php echo $_SESSION['email'];?></div>
      </div>
      <form action="profilePage.php" method="post" enctype="multipart/form-data" id="profileImageForm">
        <input type="file" name="profileImage" id="fileInput" onchange="submitForm()" style="display: none;">
        <!--profile utama-->
      </form>
      <?php
          $src = isset($_SESSION['src']) ? $_SESSION['src'] : 'assets\profileicon.png';
          echo "<img
                  id='profile-atas'
                  class='profile-circle-icon-512x512-zx1'
                  alt=''
                  src='{$src}'
                />"
        ?>  <!--profile atas-->
    </div>

   
    <div class="content" style="margin-top:3cm">
      <div class="content-web my-4">
        <div class="row">
    
        <!-- explore topic SPORT -->
        <div class="col-md-4 col-12 mb-3">
        <a href="sport.php">
          <div class="card card-explore" id="sport">
          <img src="assets\sportss.jpg" class="card-img-top card-img-bottom" width="100%" style="height:340px">
        
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
        </a>
        </div>

        <!-- explore topic MAKEUP -->
        <div class="col-md-4 col-12 mb-3">
        <a href="makeup.php">
          <div class="card card-explore" id="makeup">
          <img src="assets\makeupp.jpg" class="card-img-top card-img-bottom" width="100%" style="object-fit: cover; height:340px">
          
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
        </a>
        </div>

        <!-- explore topic KPOP -->
        <div class="col-md-4 col-12 mb-3">
        <a href="kpop.php">
          <div class="card card-explore" id="kpop">
        
          <img src="assets\kpopp.jpg" class="card-img-top card-img-bottom" width="100%" style="object-fit: cover; height:340px">
          
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
        </a>
        </div>

        <!-- explore topic HAIRSTYLE -->
        <div class="col-md-4 col-12 mb-3">
         <a href="hairstyle.php">
        <div class="card card-explore" id=hairstyle>
       
        <img src="assets\hairstylee.png" class="card-img-top card-img-bottom" width="100%" style="object-fit: cover; height:340px">
        
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
        </a>
        </div>

        <!-- explore topic DRAWING -->
        <div class="col-md-4 col-12 mb-3">
        <a href="drawing.php">
        <div class="card card-explore" id="drawing">
        
        <img src="assets\drawing.jpg" class="card-img-top card-img-bottom" width="100%" style="object-fit: cover; height:340px">
         
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
        </a>
        </div>  

        <!-- explore topic BAKING -->
        <div class="col-md-4 col-12 mb-3">
        <a href="baking.php">

        <div class="card card-explore" id="baking">
          <img src="assets\baking.jpg" class="card-img-top card-img-bottom" width="100%" style="object-fit: cover; height:340px">
          
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
        </a>
        </div>
        
        <!-- explore topic KPOP -->
        <div class="col-md-4 col-12 mb-3">
        <a href="cooking.php">

        <div class="card card-explore" id="cooking">
          <img src="assets\cooking.jpg" class="card-img-top card-img-bottom" width="100%" style="object-fit: cover; height:340px">
          
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
        </a>
        </div>

        <!-- explore topic CAR -->
        <div class="col-md-4 col-12 mb-3">
        <a href="car.php">
        <div class="card card-explore" id="car">
        
          <img src="assets\carr.jpg" class="card-img-top card-img-bottom" width="100%" style="object-fit: cover; height:340px">
          
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
        </a>
        </div>

         <!-- explore topic GAME -->
         <div class="col-md-4 col-12 mb-3">
         <a href="game.php">
        <div class="card card-explore" id="game">
        
          <img src="assets\game.jpg" class="card-img-top card-img-bottom" width="100%" style="object-fit: cover; height:340px">
          
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
        </a>
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
        window.location.href = "homePage.php";});
 
      
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
     <!-- Modal -->
    <div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-secondary">
            <h5 class="modal-title">Profile User</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="col-12 justify-content-center text-center">
              <img id="image" src="" alt="Profile Image" />
              <p class="text-capitalize pt-2 h4" id="username"></p>
              <p id="description"></p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script>
      let searchResultsDropdown = document.getElementById('search-results');

      document.getElementById('search').addEventListener('input', function(e) {
        let searchTerm = e.target.value.trim();
        
        // Make an AJAX request when the search term length is more than 2 characters
        if (searchTerm.length > 2) {
          fetch('search.php', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'searchTerm=' + encodeURIComponent(searchTerm),
          })
          .then(response => response.json())
          .then(data => {
            console.log(data);
            searchResultsDropdown.classList.remove('d-none');
            searchResultsDropdown.innerHTML = '';

            let resultsHTML = '<div class="list-group">'; 
            
            if (data.length > 0) { 
              data.forEach(result => {
                resultsHTML += `
                  <a href="#" class="p-2 text-decoration-none list-group-item-action text-capitalize" onclick="openModal('${result.username}', '${result.description}', '${result.src.replace(/\\/g, '\\\\')}')">${result.username}</a>
                `;
              });
            } else {
              resultsHTML = `
                <div class="list-group-item list-group-item-action">
                  No results found
                </div>
              `;
            }
            resultsHTML += '</div>';

            searchResultsDropdown.innerHTML = resultsHTML; 
          })
          .catch(error => {
            console.error('Error:', error);
          });
        } else {
          searchResultsDropdown.classList.add('d-none');
          searchResultsDropdown.innerHTML = ''; 
        }
      });

      function openModal(username, description, src) {
        console.log(username, description, src);
        document.getElementById('username').innerText = username;
        document.getElementById('description').innerText = description;
        document.getElementById('image').src = src;
        new bootstrap.Modal(document.getElementById('profileModal')).show();
      }
    </script>
  </body>
</html>
