<?php
function check_login($conn) {

    if (isset($_SESSION['user_id'])) {

        $id = $_SESSION['user_id'];

        $stmt = $conn->prepare(
            "SELECT id, firstname, lastname, email, role 
             FROM users 
             WHERE id = ? 
             LIMIT 1"
        );
        $stmt->execute([$id]);
        $user_data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user_data) {
            return $user_data;
        }
    }

    // User not logged in
    header("Location: user_login.php");
    exit;
}

?>

    
   
