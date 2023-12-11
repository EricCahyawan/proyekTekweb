<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['imageData'])) {
        $_SESSION['src'] = $_POST['imageData'];
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error']);
    }
} 
else {
    echo json_encode(['status' => 'error']);
}
?>