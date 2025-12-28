<?php
session_start();
require_once 'data_base.php';
require_once 'function.php';

$user = check_login($conn);


$message = "";


try {
    $stmt = $conn->query("SELECT id, firstname, lastname FROM users");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $users = [];
    $message = "<p class='msg-error'>Unable to load users.</p>";
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    /* ---- Server-side validation ---- */
    $required = ['title','firstname','lastname','email','assigned_to','type'];
    foreach ($required as $field) {
        if (empty($_POST[$field])) {
            $message = "<p class='msg-error'>Please fill in all required fields.</p>";
            break;
        }
    }

    if (empty($message)) {

        $title       = $_POST['title'];
        $firstname   = trim($_POST['firstname']);
        $lastname    = trim($_POST['lastname']);
        $email       = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        $telephone   = $_POST['telephone'] ?? null;
        $company     = $_POST['company'] ?? null;
        $type        = $_POST['type'];
        $assigned_to = (int) $_POST['assigned_to'];
        $created_by  = $_SESSION['id'];

        if (!$email) {
            $message = "<p class='msg-error'>Invalid email address.</p>";
        } else {

            /* ---- Validating if assigned user exists ---- */
            $check = $conn->prepare("SELECT id FROM users WHERE id = ?");
            $check->execute([$assigned_to]);

            if (!$check->fetch()) {
                $message = "<p class='msg-error'>Invalid user selected.</p>";
            } else {

                /* ---- Inserting contact ---- */
                try {
                    $sql = "INSERT INTO contacts 
                            (title, firstname, lastname, email, telephone, company, type, assigned_to, created_by, created_at, updated_at)
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())";

                    $stmt = $conn->prepare($sql);
                    $stmt->execute([
                        $title,
                        $firstname,
                        $lastname,
                        $email,
                        $telephone,
                        $company,
                        $type,
                        $assigned_to,
                        $created_by
                    ]);

                    $message = "<p class='msg-success'>Contact successfully created.</p>";

                } catch (PDOException $e) {
                    $message = "<p class='msg-error'>Unable to create contact. Please try again.</p>";
                    // error_log($e->getMessage());
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Contact</title>
    <link rel="stylesheet" href="add_contact_styles.css">
</head>
<body>

<header>
    <img src="dolphin_icon.png" alt="Dolphin" class="dolp_icon">
    <h1>Dolphin CRM</h1>
</header>

<nav class="sidebar">
    <?php include 'dolph_nav.php';?>
</nav>

<main class="container">
    <h2>New Contact</h2>

    <?php if (!empty($message)): ?>
        <div class="msg_container">
            <?= $message ?>
        </div>
    <?php endif; ?>

    <form method="POST">

        <div class="form-group">
            <label for="title">Title</label>
            <select id="title" name="title">
                <option value="Mr">Mr</option>
                <option value="Ms">Ms</option>
                <option value="Mrs">Mrs</option>
                <option value="Dr">Dr</option>
            </select>
        </div>

        <div class="form-group">
            <label for="firstname">First Name</label>
            <input type="text" id="firstname" name="firstname" required>
        </div>

        <div class="form-group">
            <label for="lastname">Last Name</label>
            <input type="text" id="lastname" name="lastname" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div class="form-group">
            <label for="telephone">Telephone</label>
            <input type="tel" id="telephone" name="telephone">
        </div>

        <div class="form-group">
            <label for="company">Company</label>
            <input type="text" id="company" name="company">
        </div>

        <div class="form-group">
            <label for="type">Type</label>
            <select id="type" name="type">
                <option value="Sales Lead">Sales Lead</option>
                <option value="Support">Support</option>
            </select>
        </div>

        <div class="form-group full-width">
            <label for="assigned_to">Assigned To</label>
            <select id="assigned_to" name="assigned_to" required>
                <option value="" disabled selected>Select a user</option>
                <?php foreach ($users as $user): ?>
                    <option value="<?= $user['id']; ?>">
                        <?= htmlspecialchars($user['firstname'] . ' ' . $user['lastname']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-footer">
            <button type="submit">Save</button>
        </div>

    </form>
</main>

</body>
</html>
