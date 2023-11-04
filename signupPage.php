<?php 
    session_start();
    require "db_connect.php"; 
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>signUpPage</title>
    <link rel="stylesheet" href="index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
  <section>
            <div class="form-box-reg">
                <div class="form-value">
                    <form action="signupPage.php" method="post">
                        <h2>Sign Up</h2>
                        <div class="inputbox">
                            <ion-icon name="person-outline"></ion-icon>
                            <input type="username" required>
                            <label for="">Username</label>
                        </div>
                        <div class="inputbox">
                            <ion-icon name="mail-outline"></ion-icon>
                            <input type="email" required>
                            <label for="">Email</label>
                        </div>
                        <div class="inputbox">
                            <ion-icon name="lock-closed-outline"></ion-icon>
                            <input type="password" required>
                            <label for="">Password</label>
                        </div>
                        
                        <button name="signUp" id="signUp">Sign Up</button>
                        <div class="register">
                            <p>Already have an account? Click <a href="loginPage.php">Log In</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
  <?php
        if(isset($_POST['signUp'])){
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['password'] = $_POST['password'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $query = "INSERT INTO user (username, email, password)
            VALUES ('$username', '$email', '$password')";
            $stmt = $conn->query($query); 
            session_destroy();
        }
    ?>
</html>