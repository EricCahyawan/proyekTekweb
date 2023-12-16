<?php
require_once "classes/user.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['searchTerm'])) {
    $searchTerm = $_POST['searchTerm'];

    // Lakukan sanitasi terhadap input untuk mencegah SQL injection
    $sanitizedSearchTerm = htmlspecialchars($searchTerm);

    $results = user::search_user_by_username($sanitizedSearchTerm);

    // Mengembalikan hasil pencarian dalam format JSON
    header('Content-Type: application/json');
    echo json_encode($results);
}
?>
