<?php
include_once "./config/dbconnect.php";

$search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';

$sql = "SELECT id_post, data_images, COALESCE(report_count, 0) as report_count
        FROM user_post
        WHERE id_post LIKE '%$search%'";
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
    <title>Post Deletion</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <style>
        .btn-delete {
            background-color: red;
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

<?php include_once "sidebar.php"; ?>

<div class="container mt-5">
    <h2>Post Deletion</h2>

    <form class="form-inline mb-3">
        <input class="form-control mr-sm-2" type="text" placeholder="Search by Post ID" name="search">
        <button class="btn btn-light" type="submit">Search</button>
    </form>

    <table class="table">
        <thead>
        <tr>
            <th>ID Post</th>
            <th>Data Images</th>
            <th>Report Count</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td><?= $row['id_post'] ?></td>
                    <td><?= $row['data_images'] ?></td>
                    <td class="report-count"><?= $row['report_count'] ?></td>
                    <td>
                        <button class="btn btn-delete" onclick="deletePost(<?= $row['id_post'] ?>)">Delete</button>
                    </td>
                </tr>
                <?php
            }
        } else {
            echo "<tr><td colspan='4'>No posts found</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>

<script>
    function deletePost(postId) {
        var confirmation = confirm("Are you sure you want to delete this post?");
        if (confirmation) {
            $.ajax({
                url: "deletePost.php",
                method: "post",
                data: { postId: postId },
                success: function () {
                    alert("Post deleted successfully");
                    window.location.reload();
                }
            });
        }
    }
</script>
</body>
</html>
