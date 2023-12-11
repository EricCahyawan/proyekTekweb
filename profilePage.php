<?php
  require "db_connect.php"; 
  session_start();
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
      <form action="profilePage.php" method="post">
        <div class="logout-wrapper">
          <input type="submit" value="Logout" class="logout" name="logout">
        </div>
      </form>   
      <?php
        if(isset($_POST['logout'])){
          session_destroy();
          header("Location: loginPage.php");
        }
      ?>
      <div class="posts">Posts</div>
      <form action="profilePage.php" method="post"> <!--description-->
        <textarea name="textarea" id="textarea">
          <?php
            $email = $_SESSION['email'];
            $sql = "SELECT description FROM user WHERE email = '$email'";
            $result = $conn->query($sql);
            if ($result && $result->rowCount() > 0) {
              $row = $result->fetch(PDO::FETCH_ASSOC);
              $descriptionFromDatabase = $row["description"];
              $_SESSION['description'] = $descriptionFromDatabase;
              echo $_SESSION['description'];   
              if(isset($_POST['save-changes'])){
                if(isset($_POST['textarea'])){
                  $description = $_POST['textarea'];
                  $query = "UPDATE user SET description = NULL WHERE email = '$email'";
                  $query2 = "UPDATE user SET description = '$description' WHERE email = '$email'";
                  $result = $conn->query($query);
                  $result2 = $conn->query($query2);
                  header("Location: profilePage.php");
                }
              }
            }
          ?>
        </textarea>
        <button id="description-submit" name="save-changes">Save changes</button>
      </form>
      <div id="username-email-container">
        <div class="username"><?php echo $_SESSION['username'];?></div>
        <div class="emailemailcom"><?php echo $_SESSION['email'];?></div>
      </div>
      <form action="profilePage.php" method="post">
        <input type="file" name="profileImage" id="fileInput" onchange="readURL(this);" style="display: none;">
        <!--profile utama-->
      </form>
      <?php
          $email = $_SESSION['email'];
          $query1 = "SELECT src FROM user WHERE email = '$email'";
          $result1 = $conn->query($query1);
          $row = $result1->fetch(PDO::FETCH_ASSOC);
          $_SESSION['src'] = $row['src'];
          $src = $_SESSION['src'];
          // echo "<script>window.alert('{$src}');</script>"; //di database slashnya dah bener, tapi di programnya slashnya nda keluar
          // $query2 = "UPDATE user SET src = '$src' WHERE email = '$email'";
          // $result2 = $conn->query($query2);
          echo 
          "<img
          id='profile-utama'
          class='profile-circle-icon-512x512-zx'
          alt=''
          src= '{$src}'
          />"; 
        ?>
      <div class="line-div"></div> <!--garis-->
      <img class="layer-1-icon" alt="" src="assets\Layer_1.png" /> <!--tombol add post-->
      <form action="profilePage.php" methd="post"><button name="profile-atas-btn">
        <img
          id="profile-atas"
          class="profile-circle-icon-512x512-zx1"
          alt=""
          src="assets\profileicon.png"
        /> <!--profile atas-->
      </button></form>
    </div>
  
    <script>
      var profileutama = document.getElementById("profile-utama");
      let profileinput = document.getElementById("fileInput")
      profileutama.addEventListener("click", (e) => {
      profileinput.click();
      });
      function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
              profileutama.src = e.target.result;
              var newImageSource = e.target.result;
            }
            reader.readAsDataURL(input.files[0]); 
        }
      }
      
      document.getElementById('textarea').addEventListener('keydown', function (e) {
        if (e.key === 'Enter' && !e.shiftKey) {
          e.preventDefault(); // Prevent the default Enter key behavior (new line)
          document.getElementById('description-submit').click();
        }
      });
  
      var profileatas = document.getElementById("profile-atas");
      profileatas.addEventListener("click", (e) => {
      <?php
        if(isset($_POST['profile-atas-btn']))
        {
          header("Location: profilePage.php");
        };
      ?>});

      var exploreText = document.getElementById("exploreText");
      exploreText.addEventListener("click", (e) => {
      window.alert("Clicked!");});
      
      
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