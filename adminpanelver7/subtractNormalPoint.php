<?php

include_once "./config/dbconnect.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["userId"])) {
        $userId = $_POST["userId"];

      
        $sql = "UPDATE users SET normal_points = GREATEST(normal_points - 1, 0) WHERE user_id = $userId";
        $result = $conn->query($sql);

        if ($result) {
            $response["normal_points"] = getNormalPoints($userId);
            echo json_encode($response);
        } else {
            echo "Error updating normal points: " . $conn->error;
        }
    } else {
        echo "User ID not provided.";
    }
} else {
    echo "Invalid request method.";
}

function getNormalPoints($userId) {
    $sql = "SELECT normal_points FROM users WHERE user_id = $userId";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row["normal_points"];
    } else {
        return 0;
    }
}
?>
