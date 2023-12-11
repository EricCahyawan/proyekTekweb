<?php
    $password = "eric";
    $hash = password_hash($password, PASSWORD_DEFAULT);
    if(password_verify($password, $hash)){
        echo "password benar";
    }
    else{
        echo "salah";
    }
?>