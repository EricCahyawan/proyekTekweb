<?php

include_once "./config/dbconnect.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["postId"])) {
        $postId = $_POST["postId"];

        $deletePostQuery = "DELETE FROM user_post WHERE id_post = $postId";
        $deleteResult = $conn->query($deletePostQuery);

        if ($deleteResult) {
            // Successfully deleted
            echo "Post deleted successfully";
        } else {
            // Error in deletion
            echo "Error deleting post: " . $conn->error;
        }
    } else {
        // Post ID not provided
        echo "Post ID not provided.";
    }
} else {
    // Invalid request method
    echo "Invalid request method.";
}

?>
