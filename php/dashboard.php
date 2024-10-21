<?php 
session_start();

// Check if the user is logged in
if(!isset($_SESSION['userid'])){
    header("location: login.php");
    exit();
}

echo "Welcome, " . $_SESSION ['username']
?>
<form action="php/process_form.php" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name">
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email">
        <label for="message">Message:</label>
        <textarea name="message" id="message"></textarea>
        <button type="submit">SUBMIT</button>
    </form>
    
<a href="logout.php">Logout</a>

