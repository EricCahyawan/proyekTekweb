<?php
include_once "./config/dbconnect.php";

$sql = "SELECT post_id, num_reports
        FROM posts
        ORDER BY num_reports DESC";
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
    <title>Reports</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <style>
        .btn-checked {
            background-color: green;
            color: white;
        }

        body {
            background-color: black;
            color: white;
        }

        table {
            background-color: black;
            color: white;
        }

        td, th {
            color: white;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2>Reports</h2>

    <table class="table">
        <thead>
        <tr>
            <th>Post ID</th>
            <th>Number of Reports</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
                <tr data-post-id="<?= $row['post_id'] ?>">
                    <td><?= $row['post_id'] ?></td>
                    <td><?= $row['num_reports'] ?></td>
                    <td>
                        <button class="btn btn-checked" onclick="deletePost(<?= $row['post_id'] ?>)">Checked</button>
                    </td>
                </tr>
                <?php
            }
        } else {
            echo "<tr><td colspan='3'>No posts found</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>

<script>
function deletePost(postId) {
    var clickedElement = $('[data-post-id="' + postId + '"]');

    $.ajax({
        url: "deletePost.php",
        method: "post",
        data: { postId: postId },
        success: function () {
            alert("Post deleted successfully");
            clickedElement.fadeOut(300, function () {
                clickedElement.remove();
            });
        }
    });
}
</script>

</body>
</html>
