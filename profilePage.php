<?php
  require "classes/user.php"; 
  session_start();
  $result = user::get_user_by_email($_SESSION['email']);
  $_SESSION['src'] = $result['src'];
  $currentPage = basename($_SERVER['PHP_SELF']);
  if(isset($_POST['logout'])){
    session_destroy();
    header("Location:loginPage.php");
  }
?>
<?php
  if(isset($_FILES['profileImage'])) {
    $allowedExtensions = ['jpg', 'jpeg', 'png'];
    $uploadedExtension = strtolower(pathinfo($_FILES['profileImage']['name'], PATHINFO_EXTENSION));

    // Check if the uploaded file has a valid extension
    if (in_array($uploadedExtension, $allowedExtensions)) {
        $uploadDir = 'D:/xampp/htdocs/proyekTekweb/profilepicture/';
        $uploadFile = $uploadDir . basename($_FILES['profileImage']['name']);

        // Move the uploaded file to the specified directory
        if (move_uploaded_file($_FILES['profileImage']['tmp_name'], $uploadFile)) {
            // Update the user's profile image path in the database
            $email = $_SESSION['email'];
            $imagePath = 'profilepicture/' . basename($_FILES['profileImage']['name']);;

            // Update the 'src' column in the 'user' table
            $result = user::update_user_image($email, $imagePath);

            if ($result) {
                // Redirect to the profile page or show a success message
                header("Location: profilePage.php");
                exit();
            } else {
                // Handle the database update failure
                echo "<script>window.alert('Failed to upload');</script>";
            }
        } else {
            // Handle file upload failure
            echo "<script>window.alert('Failed to move the uploaded file.');</script>";
        }
    } else {
        // Handle invalid file extension
        echo "<script>window.alert('Invalid file extension. Please upload a JPG or PNG file.');</script>";
    }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link rel="stylesheet" href="globalstylesProfilePage.css" />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Inter:wght@500;600;700&display=swap"
    />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
      #profile-child{
        position: fixed;
        background-color: #d9d9d9;
        width: 14500px;
        height: 119px;
        top: 0;
        z-index: 1;
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
      .logout {
        position: relative;
        font-weight: 600;
        background-color:transparent;
        border:none;
      }
      .logout-wrapper {
        position: absolute;
        top: 167px;
        left: 1300px;
        border-radius: 33px;
        background-color: #b64d4d;
        overflow: hidden;
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: center;
        padding: 20px 26px;
    
      }
      .posts {
        position: absolute;
        top: 660px;
        left: 687px;
        font-weight: 600;
      }
      #username-email-container{
        position: absolute;
        top: 11.4cm;
        left: 3cm;
        right: 3cm;
        display: flex;
        flex-direction: column;
        flex-wrap: nowrap;
        align-items: center;
        padding-right: 2.858cm;
      }
      .emailemailcom {
        flex: 50%;
      }
      .username{
        flex: 50%;
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
      
      .line-div {
        position: absolute;
        top: 715px;
        left: 80px;
        right: 80px;
        border-top: 3px solid #000;
        box-sizing: border-box;
        height: 3px;
      }

      .profile-child11 {
        top: 586.5px;
        left: 683.5px;
        width: 73.12px;
        height: 5px;
      }
      .profile-child11,
      .profile-child12 {
        position: absolute;
        object-fit: cover;
      }
      .profile-child12 {
        top: 1122px;
        left: 1235px;
        border-radius: 50%;
        width: 126.8px;
        height: 124.8px;
      }
      .layer-1-icon {
        position: fixed;
        top: 16cm;
        right: 4cm;
        overflow: hidden;
      }
      .profile-circle-icon-512x512-zx{
        position: absolute;
        left: 15.33cm;
        top: 4cm;
        object-fit: cover;
        width: 7cm;
        height: 7cm; /*width dan height harus sama untuk lingkaran*/
        border-radius: 50%; /*border radius 50% untuk lingkaran*/
        overflow: hidden;
      }
      .profile-circle-icon-512x512-zx1 {
        position: fixed;
        top: 27px;
        left: 1333px;
        width: 69px;
        height: 69px;
        z-index: 1;
        border-radius: 50%;
        overflow: hidden;
        object-fit: cover;
      }
      #description-submit{
        margin-top: 10cm;
        position: absolute;
        top: 20cm;
        width: 4cm;
        left: 5cm;
        background: none;
        display: none;
      }
      .profile {
        position: relative;
        background-color: #fff;
        width: 100%;
        height: 1276px;
        font-size: var(--font-size-5xl);
        color: var(--color-dimgray);
        font-family: var(--font-inter);
      
      }
      textarea {
        position: absolute;
        left: 6.9cm;
        width: 25cm;
        height: 3.6cm;
        top: 13.7cm;
        padding: 5px; 
        border: 2px solid #ccc; 
        border-radius: 4px;
        background-color: #f8f8f8; 
        resize: none; 
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
        <div id="search-results" style="background-color:white; position:absolute; top:3.3cm;"></div>
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
      <form action="profilePage.php" method="post"> <!--description-->
        <textarea name="textarea" id="textarea"><?php
          $email = $_SESSION['email'];
          $result = user :: get_user_by_email($email);
          if(isset($result['description'])){
            echo $result['description'];
          }
        ?></textarea>
        <button id="description-submit" name="save-changes">Save changes</button>
      </form> 
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
                  id='profile-utama'
                  class='profile-circle-icon-512x512-zx'
                  alt=''
                  src='{$src}'
                />";
        ?>
      <div class="line-div"></div> <!--garis-->
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
    </div>
  
    <script>
      var profileutama = document.getElementById("profile-utama");
      let profileinput = document.getElementById("fileInput");
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
      
      function submitForm() {
            // Trigger the form submission when a file is selected
            document.getElementById("profileImageForm").submit();
        }

      var profileatas = document.getElementById("profile-atas");
      profileatas.addEventListener("click", (e) => {
        window.location.href = "profilePage.php";
      });

      var exploreText = document.getElementById("exploreText");
      exploreText.addEventListener("click", (e) => {
      window.location.href = "explorePage.php";})
      
      var homeText = document.getElementById("homeText");
      homeText.addEventListener("click", (e) => {
      window.location.href="homePage.php";});
 
      
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
          <!-- Added styles for a circular image -->
          <img id="image" src="" alt="Profile Image" style="width: 200px; max-width: 100%; border-radius: 50%;" />
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