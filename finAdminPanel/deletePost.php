<?php
include_once "./config/dbconnect.php";

if (isset($_POST['postId'], $_POST['username'])) {
    $postId = $conn->real_escape_string($_POST['postId']);
    $username = $conn->real_escape_string($_POST['username']);

    $deleteQuery = "DELETE FROM posts WHERE post_id = $postId";
    $deleteResult = $conn->query($deleteQuery);

    if ($deleteResult) {
        $updateUserQuery = "UPDATE users SET normal_points = GREATEST(normal_points - 1, 0) WHERE username = '$username'";
        $updateUserResult = $conn->query($updateUserQuery);

        if ($updateUserResult) {
            $getUserPointsQuery = "SELECT normal_points FROM users WHERE username = '$username'";
            $getUserPointsResult = $conn->query($getUserPointsQuery);

            if ($getUserPointsResult && $getUserPointsResult->num_rows > 0) {
                $userRow = $getUserPointsResult->fetch_assoc();
                $normalPoints = $userRow['normal_points'];
                echo json_encode(['success' => true, 'normal_points' => $normalPoints]);
            } else {
                echo json_encode(['success' => false, 'error' => 'Failed to get updated normal points']);
            }
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed to update user normal points']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => $conn->error]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'postId or username not provided']);
}

$conn->close();
?>
