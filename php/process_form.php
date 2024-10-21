<?php
    include('db_connect.php');

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $message = $_POST['message'];

        // Sanitize name and message to remove special characters (except letters, numbers, spaces)
        $name = preg_replace("/[^a-zA-Z0-9\s]/", "", $name);
        $email = preg_replace("/[^a-zA-Z0-9-@\s]/", "", $email);
        $message = preg_replace("/[^a-zA-Z0-9\s]/", "", $message);

        // Sanitize input to prevent SQL injection
        $name = mysqli_real_escape_string($conn, $name);
        $email = mysqli_real_escape_string($conn, $email);
        $message = mysqli_real_escape_string($conn, $message);

        $sql = "INSERT INTO users(name, email, message) VALUES(?,?,?)";

        if($stmt = $conn->prepare($sql)){
            $stmt->bind_param("sss", $name, $email, $message);

            if($stmt->execute()){
                echo "The Data was Succesfully Inserted.";
            }else{
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $stmt->close();
        }

        $conn->close();
    }else{
        echo "Invalid Request Method";
    }
?>