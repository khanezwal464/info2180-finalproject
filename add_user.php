<?php
session_start();
require_once 'data_base.php';

$message = "";

/* Admin Only Access */
if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'Admin') {
    die("<p style='color:red;'>Access denied. Admins only.</p>");
}

/*Handling Form Submission*/
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    /* ---- INPUT SANITIZATION ---- */
    $firstname = trim($_POST['firstname']);
    $lastname  = trim($_POST['lastname']);
    $email     = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
    $role      = $_POST['role'];
    $password  = $_POST['password'];

    /* ---- PASSWORD REGEX ---- */
    $regex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/';

    if (!$email) {
        $message = "<p class='msg-error'>Invalid email format.</p>";
    } elseif (!preg_match($regex, $password)) {
        $message = "<p class='msg-error'>
            Password must be at least 8 characters long and contain
            one uppercase letter, one lowercase letter, and one number.
        </p>";
    } else {

        try {
            /* ---- Hashing Password */
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            /* ----Inserting User */
            $stmt = $conn->prepare(
                "INSERT INTO users (firstname, lastname, email, password, role)
                 VALUES (?, ?, ?, ?, ?)"
            );

            $stmt->execute([
                $firstname,
                $lastname,
                $email,
                $hashed_password,
                $role
            ]);

            $message = "<p class='msg-success'>User added successfully!</p>";

        } catch (PDOException $e) {
            $message = "<p class='msg-error'>Email already exists.</p>";
        }
    }
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
    <img src="iolphin_icon.png" alt="Dolphin CRM Logo" class="dolp_icon">
    <h1>Dolphin CRM</h1>
</header>

<?php include 'dolph_nav.php'; ?>

<div class="container">
    <h2>New User</h2>

    <!-- ✅ MESSAGE DISPLAY (THIS WAS MISSING) -->
    <?php if (!empty($message)): ?>
        <div class="message-box">
            <?= $message ?>
        </div>
    <?php endif; ?>

    <form method="POST">

        <div class="form-group">
            <label for="firstname">First Name</label>
            <input id="firstname" name="firstname" required>
        </div>

        <div class="form-group">
            <label for="lastname">Last Name</label>
            <input id="lastname" name="lastname" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input id="email" name="email" type="email" required>
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

        <div class="form-footer">
            <button type="submit">Save</button>
        </div>
    </form>
</div>

</body>
</html>
