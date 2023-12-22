<?php

include_once "./config/dbconnect.php"; 


$sql = "SELECT post_id, image_url, like_count, dislike_count, username FROM posts ORDER BY like_count DESC";
$result = $conn->query($sql);

if (!$result) {
    die("Query failed: " . $conn->error);
}

$posts = array();

while ($row = $result->fetch_assoc()) {
    $posts[] = $row;
}


echo json_encode(array('posts' => $posts));

$conn->close();
?>
