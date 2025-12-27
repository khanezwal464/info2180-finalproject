<?php

session_start();

require("data_base.php"); 
include("function.php");

$hash = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'; 
var_dump(password_verify('password123', $hash));

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $email = filter_var($_POST["email"], FILTER_SANITIZE_STRING);
    $password = $_POST["password"];
    //$password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);
    //$hash = password_hash($password, PASSWORD_DEFAULT);
    //$i_hash = hash('sha256', $password);

    if (!empty($email) && !empty($password)) {
        $stmt = $conn -> prepare("SELECT * FROM Users WHERE email =? LIMIT 1 ");
        $stmt->execute([$email]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $user_data = $result;
                
          //if ($user_data['password'] === $i_hash || password_verify($password, $hash)) {
            if (password_verify($password, $user_data['password'])) {
                $_SESSION['email'] = $user_data['email'];
                //$_SESSION['username'] = $user_data['firstname'] . $user_data['lastname'];
                $_SESSION['username'] = $user_data['firstname'] . ' ' . $user_data['lastname'];
                $_SESSION['id'] = $user_data['id'];
                $_SESSION['role'] = $user_data['role'];
                
                header("Location: dashboard.php");
                exit;
                
            } else {
                echo "<script>alert('Incorrect username or password');</script>";
            }
        } else {
            echo "<script>alert('Incorrect username or password');</script>";
        }
    } else {
        echo "<script>alert('Please enter a valid email and password');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link href="user_login_styles.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
    <title>Dolphin Login</title>
</head>
<body>
    <header>
        <div class="Header">
            <img src="dph.png" alt="Dolphin Logo" id="dolphin">
            <h1>Dolphin CRM</h1>
        </div>
    </header>
    <main>
        <div id="form">
            <form method="post">
                <h1>User Login</h1>
                <div class="input">
                    <input type="text" name="email" placeholder="Email"> 
                </div>
                <div class="input">
                    <input type="password" name="password" placeholder="Password"> 
                </div>
                <div class="input">
                    <input type="submit" value="Login" id="button" name="submit">
                    
                </div>
            </form>
        </div>
    </main>
    <footer>
        <p>Copyright &copy; 2025 Dolphin CRM <br>References <a href="https://www.flaticon.com/free-icons/dolphin" title="dolphin icons">Dolphin icons created by Freepik - Flaticon</a></p>
    </footer>
</body>
</html>
