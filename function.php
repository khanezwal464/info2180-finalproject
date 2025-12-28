<?php

 function check_login($conn) { 
     if (isset($_SESSION['email'])) { 
         $email = $_SESSION['email'];             
         $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? LIMIT 1"); 
         $stmt->execute([$email]); $user_data = $stmt->fetch(PDO::FETCH_ASSOC); 

        if ($user_data) { 
            return $user_data; 
        } 
    }  

    header("Location: user_login.php"); 
    exit; 

}

?>
    
   
