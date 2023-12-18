<?php
   session_start();
   include_once "./config/dbconnect.php";
?>

<nav class="navbar navbar-expand-lg navbar-light px-5" style="background-color: black;">
    
    <a class="navbar-brand ml-5" href="./index.php">
        postpulse admin
    </a>
    
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0"></ul>
    
    <div class="user-cart">  
        <?php           
        if(isset($_SESSION['user_id'])){
          ?>
          <span style="font-size: 18px; color: white;">Postpulse Admin</span>
          <?php
        } else {
            ?>
            <a href="" style="text-decoration:none;">
                <i class="fa fa-sign-in mr-5" style="font-size:30px; color: white;" aria-hidden="true"></i>
            </a>

            <?php
        } ?>
    </div>  
</nav>
