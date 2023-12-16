<?php


include_once "./config/dbconnect.php"; 


$search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';


$sql = "SELECT user_id, username, email, COALESCE(ban_points, 0) as ban_points, COALESCE(normal_points, 0) as normal_points 
        FROM users 
        WHERE username LIKE '%$search%'";
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
    <title>User Management</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <style>
        
        .btn-subtract {
            background-color: grey;
            color: white;
        }

        .btn-ban {
            background-color: red;
            color: white;
        }

        .btn-unban {
            background-color: yellow;
            color: black;
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
    <h2>User Management</h2>

    
    <form class="form-inline mb-3">
        <input class="form-control mr-sm-2" type="text" placeholder="Search by Username" name="search">
        <button class="btn btn-light" type="submit">Search</button>
    </form>

    <table class="table">
        <thead>
        <tr>
            <th>Username</th>
            <th>Email</th>
            <th>Ban Points</th>
            <th>Normal Points</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td><?= $row['username'] ?></td>
                    <td><?= $row['email'] ?></td>
                    <td class="ban-points"><?= $row['ban_points'] ?></td>
                    <td class="normal-points"><?= $row['normal_points'] ?></td>
                    <td>
                        <button class="btn btn-subtract" onclick="subtractNormalPoint(<?= $row['user_id'] ?>)">-1</button>
                        <?php
                        
                        if ($row['ban_points'] == 1) {
                            echo '<button class="btn btn-unban" onclick="updateBanStatus(' . $row['user_id'] . ', 0)">Unban</button>';
                        } else {
                            echo '<button class="btn btn-ban" onclick="updateBanStatus(' . $row['user_id'] . ', 1)">Ban</button>';
                        }
                        ?>
                    </td>
                </tr>
                <?php
            }
        } else {
            echo "<tr><td colspan='5'>No users found</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>
<script>
function subtractNormalPoint(userId) {
    var clickedElement = $('[data-user-id="' + userId + '"] .normal-points');

    $.ajax({
        url: "subtractNormalPoint.php",
        method: "post",
        data: { userId: userId },
        success: function (data) {
            
            alert("Point decremented successfully");
            clickedElement.text(data.normal_points);
        }
    });
}

function updateBanStatus(userId, newBanPoints) {
    var clickedElement = $('[data-user-id="' + userId + '"]').filter('.ban-points');

    $.ajax({
        url: "updateBanStatus.php",
        method: "post",
        data: { userId: userId, newBanPoints: newBanPoints },
        success: function (data) {
            
            alert("Ban status updated successfully");
            clickedElement.text(data.ban_points);
        }
    });
}

</script>
</body>
</html>
