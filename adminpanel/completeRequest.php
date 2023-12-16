<?php
include_once "./config/dbconnect.php";

if (isset($_POST['requestId'])) {
    $requestId = $_POST['requestId'];
    $sql = "DELETE FROM requests WHERE request_id = $requestId";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(array('success' => true));
    } else {
        echo json_encode(array('success' => false, 'error' => $conn->error));
    }
} else {
    echo json_encode(array('success' => false, 'error' => 'Request ID not provided'));
}

$conn->close();

?>
