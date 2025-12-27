<?php
 // require_once 'includes/auth.php';
require_once 'data_base.php';
//admin_req();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare(
        "INSERT INTO contacts (title, firstname, lastname, email, telephone, company, type, assigned_to)
        VALUES (?,?,?,?,?,?,?,?)"
    );

    $stmt->execute([
        $_POST['title'],
        $_POST['firstname'],
        $_POST['lastname'],
        $_POST['email'],
        $_POST['telephone'],
        $_POST['company'],
        $_POST['type'],
        $_POST['assigned_to']
    ]);

}

?>

<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <link rel="stylesheet" href="">
    <title>New Contact</title>
</head>
<body>

<header>
    <img src="images/dolphin_icon.png" alt="Dolphin CRM Logo" class="header_logo">
    <h1>Dolphin CRM</h1>
</header>

<nav class="sidebar">
    <?php include 'dolph_nav.php';?>
</nav>

<div class="container">
    <h2>New Contact</h2>

    <form method="POST">
        <div class="form-group title-group">
            <label for="title">Title</label>
            <select id="title" name="title">
                <option value="Mr">Mr</option>
                <option value="Ms">Ms</option>
                <option value="Dr">Dr</option>
            </select>

        </div>
        <!--- Maintaining 2 column-grid in desktop view ---->
        <div class="form-group hide-mobile"></div> <div class="form-group">
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
            <label for="telephone">Telephone</label>
            <input id="telephone" name="telephone" type="tel">
        </div>

        <div class="form-group"> 
            <label for="company">Company</label>
            <input id="company" name="company">
        </div>

         <div class="form-group"> 
            <label for="type">Type</label>
            <select id="type" name="type">
                <option value="Sales Lead">Sales Lead</option>
                <option value="Support">Support</option>
            </select>
        </div>

        <div-class="form-group">
            <label> for="assigned-to">Assigned To</label>
            <select id="assigned_to" name="assigned_to">
                <option value="Andy Bernard</option
            </select>
        </div>


    </form>
</div>



</body>
</html>