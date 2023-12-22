n <?php
include_once "./config/dbconnect.php";

$sql = "SELECT request_id, username, request_text
        FROM requests
        ORDER BY request_id DESC";
$result = $conn->query($sql);

if (!$result) {
    die("Query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Requests</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <style>
        body {
            background-color: #000; 
            color: white;
        }

        .card-container {
            display: flex;
            flex-wrap: wrap;
        }

        .card {
            width: 200px;
            margin: 10px;
            padding: 10px;
            background-color: #ffd700;
            border: 1px solid #ddd;
            border-radius: 8px;
            color: black;
        }

        .card:nth-child(2n) {
            background-color: #ffb6c1;
        }

        .card:nth-child(3n) {
            background-color: #add8e6;
        }

        .card:nth-child(4n) {
            background-color: #ffd700;
        }

        .card:nth-child(5n) {
            background-color: #d3d3d3; 
        }

        .btn-done {
            background-color: #00fa9a; 
            color: white;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2>Requests</h2>

    <div class="card-container">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
                <div class="card" data-request-id="<?= $row['request_id'] ?>">
                    <p><strong>ID:</strong> <?= $row['request_id'] ?></p>
                    <p><strong>Username:</strong> <?= $row['username'] ?></p>
                    <p><?= $row['request_text'] ?></p>
                    <button class="btn btn-done" onclick="completeRequest(<?= $row['request_id'] ?>)">Done</button>
                </div>
                <?php
            }
        } else {
            echo "<p>No requests found</p>";
        }
        ?>
    </div>
</div>

<script>
function completeRequest(requestId) {
    var clickedElement = $('[data-request-id="' + requestId + '"]');

    $.ajax({
        url: "completeRequest.php",
        method: "post",
        data: { requestId: requestId },
        success: function () {
            alert("Request completed successfully");
            clickedElement.fadeOut(300, function () {
                clickedElement.remove();
            });
        }
    });
}
</script>
</body>
</html>
