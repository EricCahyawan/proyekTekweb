<?php


include_once "./config/dbconnect.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["userId"])) {
        $userId = $_POST["userId"];

        
        $getCurrentBanPoints = "SELECT ban_points FROM users WHERE user_id = $userId";
        $currentResult = $conn->query($getCurrentBanPoints);

        if ($currentResult && $currentResult->num_rows > 0) {
            $currentRow = $currentResult->fetch_assoc();
            $currentBanPoints = $currentRow["ban_points"];

            
            $newBanPoints = $currentBanPoints == 1 ? 0 : 1;

            
            $updateBanPoints = "UPDATE users SET ban_points = $newBanPoints WHERE user_id = $userId";
            $updateResult = $conn->query($updateBanPoints);

            if ($updateResult) {
                $response["ban_points"] = $newBanPoints;
                echo json_encode($response);
            } else {
                echo "Error updating ban points: " . $conn->error;
            }
        } else {
            echo "Error retrieving current ban points: " . $conn->error;
        }
    } else {
        echo "User ID not provided.";
    }
} else {
    echo "Invalid request method.";
}
?>
