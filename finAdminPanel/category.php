
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
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
    <h2>Categories</h2>

    <table class="table">
        <thead>
            <tr>
                <th>category ID</th>
                <th>name</th>
            </tr>
        </thead>
        <tbody>
        <?php

        include_once "./config/dbconnect.php";

    
        $sql = "SELECT categoryID, name FROM categories";
        $result = $conn->query($sql);
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["categoryID"] . "</td>";
                echo "<td>" . $row["name"] . "</td>";
                echo "<td>
                        <form action='category.php' method='post'>
                            <input type='hidden' name='categoryId' value='" . $row["categoryID"] . "'>
                        </form>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>0 results</td></tr>";
        }
        $conn->close();
        ?>
    </tbody>
</table>
</div>
</body>
</html>