<?php 
    require "db_connect.php"; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>signUpPage</title>
    <link rel="stylesheet" href="index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        /* untuk tombol "Toggle Password" */
        .toggle-password {
            position: relative;
            display: flex;
            align-items: center; /* agar ikon dan input sejajar secara vertikal */
            user-select: none;
        }

        .toggle-password input {
            padding-right: 30px;
            flex-grow: 1; /* agar input mengisi sisa ruang yang tersedia */
        }

        .toggle-password .toggle-icon {
            margin-left: -30px; 
            cursor: pointer;
        }

        /* properti border-radius untuk button "Sign Up" */
        #signUp {
            border-radius: 10px; /* agar sudut tidak siku jadi seperti pada login */
        }
    </style>
</head>
<body>
    <section>
        <div class="form-box-reg">
            <div class="form-value">
                <form action="signupPage.php" method="post">
                    <h2>Sign Up</h2>
                    <div class="inputbox">
                        <ion-icon name="person-outline"></ion-icon>
                        <input type="username" name="username" required>
                        <label for="">Username</label>
                    </div>
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
    if(isset($_POST['signUp'])){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $checkEmailQuery = "SELECT * FROM user WHERE email = '$email'";
        $result = $conn->query($checkEmailQuery);
        $rowCount = $result->rowCount();
        if ($rowCount > 0) {
            echo "<script>window.alert('Email already registered. Please use a different email.');</script>";
        } else {
            $query = "INSERT INTO user (username, email, password) VALUES ('$username', '$email', '$hashedPassword')";
            $stmt = $conn->query($query); 
            echo "<script>window.alert('Registration successful!');</script>";
        }
    }
?>
</html>
