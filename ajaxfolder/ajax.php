<?php
    require "classes/user.php";
    
    if ($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['email']) && isset($_GET['description'])) {
        // Update the user description
        user::add_description_user_by_email($_GET['description'], $_GET['email']);
        
        // Fetch the updated user data
        $result = user::get_user_by_email($_GET['email']);
        
        // Return the user data as JSON response
        echo json_encode($result);
    }
?>

