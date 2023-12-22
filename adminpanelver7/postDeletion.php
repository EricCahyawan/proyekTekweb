<?php
include_once "./config/dbconnect.php";

$search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';

$sql = "SELECT post_id, image_url, username
        FROM posts
        WHERE post_id LIKE '%$search%'
        ORDER BY post_id DESC";
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

        .img-error {
            width: 50px;
            height: 50px;
            background-color: gray;
            color: white;
            text-align: center;
            line-height: 50px;
            font-size: 12px;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2>Post Deletion</h2>

    <form class="form-inline mb-3">
        <input class="form-control mr-sm-2" type="text" placeholder="Search by Post ID" name="search" value="<?php echo $search; ?>">
        <button class="btn btn-light" type="submit">Search</button>
    </form>

    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Username</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody id="postTableBody">
        </tbody>
    </table>
</div>

<script>
function fetchAndDisplayPosts() {
    $.ajax({
        url: "fetchPosts.php",
        method: "post",
        dataType: "json",
        success: function (data) {
            updateTable(data.posts);
        }
    });
}

function updateTable(posts) {
    var tableBody = $("#postTableBody");
    tableBody.empty();

    posts.forEach(function (post) {
        // Construct the image URL
        var imageUrl = "http://localhost/adminpanelver7/" + post.image_url;

        // Check if the image exists before trying to load it
        imageExists(imageUrl, function (exists) {
            var imageTag;

            if (exists) {
                imageTag = "<img src='" + imageUrl + "' alt='Post Image' width='50'>";
            } else {
                imageTag = "<div class='img-error'>Image not found</div>";
            }

            var row = "<tr data-post-id='" + post.post_id + "'>" +
                "<td>" + post.post_id + "</td>" +
                "<td>" + imageTag + "</td>" +
                "<td>" + post.username + "</td>" +
                "<td><button class='btn btn-delete' onclick='deletePost(" + post.post_id + ",\"" + post.username + "\")'>Delete</button></td>" +
                "</tr>";

            tableBody.append(row);
        });
    });
}

// Function to check if an image exists
function imageExists(url, callback) {
    var img = new Image();
    img.onload = function () {
        callback(true);
    };
    img.onerror = function () {
        callback(false);
    };
    img.src = url;
}

function deletePost(postId, username) {
    $.ajax({
        url: "deletePost.php",
        method: "post",
        data: { postId: postId, username: username },
        dataType: "json",
        success: function (data) {
            if (data.success) {
                alert("Post deleted successfully.");
                fetchAndDisplayPosts();
            } else {
                alert("Failed to delete post.");
            }
        }
    });
}

fetchAndDisplayPosts();

</script>

</body>
</html>
