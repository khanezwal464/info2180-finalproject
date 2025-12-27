<!DOCTYPE html>
<html>
<head>
  
  <meta charset="utf-8">
	<title>Contact Detail Page</title>

  <link href="view_contact.css" type="text/css" rel="stylesheet"/>
  
</head>
<body>

  <header>
    <h1>Dolphin CRM</h1>
  </header>

	<div class="container">
		<div class="sidebar">
			<?php include'dolph_nav.php';?>
		</div>


<?php

  $host = 'localhost';
  $username = 'finalproj_user';
  $password = 'password123';
  $dbname = 'dolphin_crm';

  
  try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
      
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	} catch (PDOException $e) {
	  die("Connection failed: " . $e->getMessage());
}


	$email = $_GET['email'];
	
	//Sanitisation of user input
	$email = filter_var($_GET['email'], FILTER_SANITIZE_EMAIL);
	
	
	$stmt = $pdo->prepare("SELECT firstname, lastname, email, telephone, company, assigned_to, created_by, updated_at FROM contacts WHERE email = :email"); 
	$stmt->execute([$email]); 
	$contact = $stmt->fetch(PDO::FETCH_ASSOC);

	if ($contact)

	?>

  <div class="contact_page">
	  
		<div class="header_details">
			<h2><?= htmlspecialchars($contact['firstname'] . ' ' . $contact['lastname']) ?></h2>
            <p><strong>Created By:</strong> <?= htmlspecialchars($contact['created_by']) ?></p>
            <p><strong>Updated At:</strong> <?= htmlspecialchars($contact['updated_at']) ?></p>
		</div>
	  
	  	<div class="buttons">
			<button onclick="">Assign</button>
      		<button onclick="">Switch</button>
		</div>

	  
		<?php
	    echo '<table class="other_details">
	          <thead>
	          <tr>
	          <th>Email</th>
	          <th>Telephone</th>
	          <th>Company</th>
	          <th>Assigned To</th>
	          </tr>
	          </thead>
			        <tbody>
					  <tr>
					  <td>' . htmlspecialchars($contact['email']) . '</td>
	                  <td>' . htmlspecialchars($contact['telephone']) . '</td>
	                  <td>' . htmlspecialchars($contact['company']) . '</td>
	                  <td>' . htmlspecialchars($contact['assigned_to']) . '</td>
	                  </tr>
					</tbody>
					</table>';
	          ?>  
	</div>
	</div>	

</body> 
</html>

