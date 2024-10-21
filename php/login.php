<?php 
session_start(); // Start the Session

// Include database connection
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if user exists in the database
    $sql = "SELECT * FROM user WHERE email = ?";
    $stmt = $conn->prepare($sql);

    if($stmt) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if($user && password_verify($password, $user['password'])) { // Verify the hashed password
            // Store user info in session
            $_SESSION['userid'] = $user['userid'];
            $_SESSION['username'] = $password['username'];
            // Redirect user to a welcome page or the dashboard
            header("location: dashboard.php");
            exit(); // This stop the script execution after the redirection of the user
        } else {
            echo "Invalid email or password!";
        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
}
$conn->close();
?>

