<?php

session_start();

require("data_base.php"); 
include("function.php"); 
$user_data = check_login($conn); 


?>

<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset="utf-8">

        <link href="dashboard_styles.css" rel = "stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">

        <script src="dashboard_script.js"></script>
        <script src="notes.js"></script>
        
    </head>

    <body>   
        
        <header>
        	<img src="dolphin_icon.png" alt="Dolphin" class="dolp_icon">
        	<h1>Dolphin CRM</h1>
        </header>


        <main>
            <div id = "head">
                <h2>Dashboard</h2>
                <button id = "newContact">+ Add Contact</button>
            </div>

            <div class="table_section">
                <div id = "filterOp">
                    <img id = "filter" src="filter_icon.png">
                    <label for = "filterOp" id="function">Filter By: </label>
    
                    <p id = "General" class = "filter">All</p>
                    <p id= "Sales" class = "filter">Sales Leads</p>
                    <p id = "Support" class = "filter">Support</p>
                    <p id = "Assigned" class = "filter">Assigned to me</p>
                </div>
                    <div id="result"></div>
            </div>
        </main>

        <?php include 'dolph_nav.php';?>

    
        

    </body>

</html>
