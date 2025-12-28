
<?php

session_start();
require_once 'data_base.php';



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $conn->prepare(
        "INSERT INTO users (firstname, lastname, email, password, role) VALUES (?,?,?,?,?)"
    );
    $stmt->execute([
        $_POST['firstname'],
        $_POST['lastname'],
        $_POST['email'],
        password_hash($_POST['password'], PASSWORD_DEFAULT),
        $_POST['role']
    ]);
}

?>
<!DOCTYPE html> 
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <link rel="stylesheet" href="add_user_styles.css">
    <title>New User</title>
</head>
<body>

<header>
    <img src="dolphin_icon.png" alt="Dolphin" class="dolp_icon">
    <h1>Dolphin CRM</h1>
</header>

<nav class="sidebar">
    <?php include 'dolph_nav.php';?>
</nav>

<div class="container">
    <h2>New User</h2>
    <form method="POST">
        <div class="form-group">
            <label for="firstname">First Name</label>
            <input id="firstname" name="firstname" placeholder="Jane" required>
        </div>
        <div class="form-group">
            <label for="lastname">Last Name</label>
            <input id="lastname" name="lastname" placeholder="Doe" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input id="email" name="email" type="email" placeholder="something@example.com" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input id="password" name="password" type="password" required>
        </div>
        <div class="form-group">
            <label for="role">Role</label>
            <select id="role" name="role">
                <option value="Member">Member</option>
                <option value="Admin">Admin</option>
            </select>
        </div>
        
        <div class="form-group"></div>

        <div class="form-footer">
            <button type="submit">Save</button>
        </div>
    </form>
</div> </body>
</html>
