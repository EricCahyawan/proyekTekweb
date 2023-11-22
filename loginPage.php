<!DOCTYPE html>
<?php 
    require "db_connect.php"; 
    session_start();
?>
<html lang="en">
<head>
    <link rel="stylesheet" href="index.css">
    <title>Login</title>
    <style>
        /* Style untuk tombol "Toggle Password" */
        .toggle-password {
            position: relative;
            display: flex;
            align-items: center; /* supaya ikon sejajar */
            user-select: none;
        }

        .toggle-password input {
            padding-right: 30px;
            flex-grow: 1; /* agar input psds rusng tersedia */
        }

        .toggle-password .toggle-icon {
            margin-left: -30px; /* Menggeser ikon kekiri agar sejajar dengan input */
            cursor: pointer;
        }
    </style>
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
                    <div class="inputbox toggle-password">
                        <input type="password" name="password" id="password" required>
                        <div class="toggle-icon" onclick="togglePasswordVisibility('password')">
                            <ion-icon name="eye-outline"></ion-icon>
                        </div>
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
    <script>
        // Fungsi untuk menampilkan atau sembunyikan password
        function togglePasswordVisibility(passwordFieldId) {
            const passwordField = document.getElementById(passwordFieldId);
            const toggleIcon = document.querySelector(`#${passwordFieldId} + .toggle-icon ion-icon`);

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.setAttribute('name', 'eye-off-outline');
            } else {
                passwordField.type = 'password';
                toggleIcon.setAttribute('name', 'eye-outline');
            }
        }
    </script>
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
                $_SESSION['password'] = $row['password'];
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