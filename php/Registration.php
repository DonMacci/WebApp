<?php 
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

    // check if email is already exists
    $check_email = "SELECT email FROM user WHERE email = ?";
    $stmt = $conn->prepare($check_email);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0){
        echo "Email is already registered!";
    } else {
        // instert the new user if email is not found
        $sql = "INSERT INTO user (username, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt){
            $stmt->bind_param("sss", $username, $email, $password);

            if ($stmt->execute()){
                echo "Registration has been successful! You can now <a href='login.php'>login</a>";
            } else {
                echo "Error: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Error preparing statement: " . $conn->error;
        }
    }
}
$conn->close();
?>

<!--- REGISTRATION FORM --->
<form action = "registration.php" method = "POST">
    <label>Username:</label>
    <input type ="text" name="username" required></br>

    <label>Email:</label>
    <input type ="text" name="email" required></br>

    <label>Password:</label>
    <input type ="password" name="password" required></br>

    <button type ="submit">Register</button>
</form>