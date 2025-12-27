<?php

session_start();

include("connection.php"); 
include("function.php"); 
$user_data = check_login($conn); 


?>

<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset="utf-8">
        <title>Dolphin CRM</title>

        <link href="DASH_styles.css" rel = "stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">

        <script src="DASH_script.js"></script>
        <script src="notes.js"></script>


    </head>

    <body>   

        <main>
            <div id = "head">
                <h2>Dashboard</h2>
                <button id = "newContact">+ Add Contact</button>
            </div>
            
            <div id = "filterOp">
                <img id = "filter" src="filter.png">
                <label for = "filterOp" id="function">Filter By: </label>

                <p id = "General" class = "filter">All</p>
                <p id= "Sales" class = "filter">Sales Leads</p>
                <p id = "Support" class = "filter">Support</p>
                <p id = "Assigned" class = "filter">Assigned to me</p>
            </div>

            
            <div id="result"></div>
    

        </main>

        <?php include 'navbar.php';?>

    
        

    </body>

</html>