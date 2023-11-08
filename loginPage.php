<?php 
    require "db_connect.php"; 
    session_start();
?>
<html>
    <head>
        <link rel="stylesheet" href="index.css">
        <title>Login</title>
    </head>
    <body>
        <section>
            <div class="form-box">
                <div class="form-value">
                    <form action="loginPage.php" method="post">
                        <h2>Login</h2>
                        <div class="inputbox">
                            <ion-icon name="mail-outline"></ion-icon>
                            <input type="email" name="email" required>
                            <label for="">Email</label>
                        </div>
                        <div class="inputbox">
                            <ion-icon name="lock-closed-outline"></ion-icon>
                            <input type="password" name="password" required>
                            <label for="">Password</label>
                        </div>
                        <div class="forget">
                            <label for=""><input type="checkbox">Save Account <a href="#"></a></label>
                        </div>
                        <button name="logIn">Log In</button>
                        <div class="register">
                            <p>Don't have an account? Click <a href="signupPage.php">Sign Up</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    </body>
    <?php
    if(isset($_POST['logIn'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $query = "SELECT username, email, password FROM user WHERE email = '$email'";
        $result = $conn->query($query);
        $rowcount = $result->rowCount();
        if($rowcount > 0){
            $row = $result->fetch();
            $hashedPassword = $row['password'];
            if(password_verify($password, $hashedPassword)){
                $_SESSION['username'] = $row['username'];
                $_SESSION['email'] = $row['email'];
                $_SESSIOn['password'] = $row['password'];
                header("Location: mainPage.php");
            } 
            else {
                echo '<script>window.alert("Invalid Password");</script>';
            }
        }
        else{
            echo "<script>window.alert('Email doesn\'t exist');</script>";
        }
    }
    ?>
</html>