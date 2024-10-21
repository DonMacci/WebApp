<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "project_webapp";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT user_ID, name, email, message, created_at FROM users";
    $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users List</title>
<style>
    body{
        font-family: Arial, sans-serif;
        margin: 20px;
        background-color: #f4f4f4;
    }
    h1{
        color: #333;
    }
    table{
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    table, th, td{
        border: 1px solid #ddd;
    }
    th, td{
        padding: 12px;
        text-align: left;
    }
    th{
        background-color: #4caf50;
        color: white;
    }
    tr:nth-child(even){
        background-color: #f2f2f2;
    }
</style>
<head>
    <body>
        <h1>User Lists</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Message</th>
            <th>Created_at</th>
        </tr>

        <?php
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                echo "<tr>";
                echo "<td>" . $row["user_ID"] . "</td>";
                echo "<td>" . $row["name"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["message"] . "</td>";
                echo "<td>" . $row["created_at"] . "</td>";
                echo "<tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No Users found</td></tr>";
        }
        ?>
    </table>
</body>
</html>

<?php
$conn->close();
?>

