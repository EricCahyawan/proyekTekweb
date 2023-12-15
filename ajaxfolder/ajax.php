<?php
    require "classes/user.php";
    if($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['email']) && isset($_GET['condition']) && isset($_GET['topic'])){ //update follow unfollow
        user :: set_topic_by_email($_GET['email'], $_GET['condition'], $_GET['topic']);
    }
?>
