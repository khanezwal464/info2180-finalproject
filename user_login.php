<?php
session_start();

require_once 'data_base.php';
include 'function.php';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // 2. Sanitize input
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $password = $_POST["password"];

    if (!empty($email) && !empty($password)) {
        
        // 3. Database Query using $conn from data_base.php
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? LIMIT 1");
        $stmt->execute([$email]);
        $user_data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user_data) {
            
            // 4. SHA256 Hashing to match your SQL: SHA2('password', 256)
         // $hashed_input = hash('sha256', $password);
            $hashed_input = substr(hash('sha256', $password), 0, 40);
            

            
            if ($hashed_input === $user_data['password']) {
                
                // 5. Set Session variables consistently
                $_SESSION['user_id'] = $user_data['id']; 
                $_SESSION['email'] = $user_data['email'];
                $_SESSION['username'] = $user_data['firstname'] . ' ' . $user_data['lastname'];
                $_SESSION['role'] = $user_data['role'];
                
                header("Location: dashboard.php");
                exit;
                
            } else {
                $error = "Incorrect email or password";
            }
        } else {
            $error = "Incorrect email or password";
        }
    } else {
        $error = "Please enter both email and password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dolphin CRM - Login</title>
    <link rel="stylesheet" type="text/css" href="user_login_styles.css">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
</head>
<body>

<header>
    <img src="images/dolphin_icon.png" alt="Dolphin Logo" class="header_logo">
    <h1>Dolphin CRM</h1>
</header>

<main>
    <div class="login-card">

        <div class="login-header">
            <h2>Login</h2>
        </div>

        <form method="post" class="login-form">

            <div class="input-wrapper">
                <input type="email" name="email" placeholder="Email address" required>
            </div>

            <div class="input-wrapper">
                <input type="password" name="password" placeholder="Password" required>
            </div>

            <button type="submit" class="login-btn">
                <img src="images/lock_icon.png" alt="" class="lock-icon">
                Login
            </button>

        </form>

    </div>
</main>

<footer>
    <p>Copyright © 2025 Dolphin CRM</p>
</footer>

<?php if (isset($error)): ?>
<script>alert('<?php echo $error; ?>');</script>
<?php endif; ?>

</body>

</html>