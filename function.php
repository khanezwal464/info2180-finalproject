<?php

/*function check_login($conn){ 
    if(isset($_SESSION['email'])){
        $email = $_SESSION['email'];
        $query = "select * from users where email = '$email' limit 1"; 

        $result = mysqli_query($conn, $query);
        if($result && mysqli_num_rows($result) > 0){

            $user_data = mysqli_fetch_assoc($result);

            return $user_data;

        }
    }

    else{

    header("Location: UL_session.php"); 
    die;
    }
}*/

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
    
   
