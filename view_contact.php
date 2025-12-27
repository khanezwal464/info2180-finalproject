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
			<button onclick="">Assign</button>
      		<button onclick="">Switch</button>
		</div>

	  		<?php
	    echo '<table class="other_details">
	          <thead>
	          <tr>
	          <th>Name</th>
	          <th>Created By</th>
	          <th>Updated At</th>
	          </tr>
	          </thead>
	          <tbody>';
	          
	          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$name = $row['firstname'] . ' ' . $row['lastname'];
	            echo '<tr>
	                  <td>' . htmlspecialchars($name) . '</td>
	                  <td>' . htmlspecialchars($row['created_by']) . '</td>
	                  <td>' . htmlspecialchars($row['updated_at']) . '</td>
	                  </tr>';
	          }
	            echo '</tbody></table>';
	          ?>

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
	          <tbody>';
	          
	          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
	            echo '<tr>
	                  <td>' . htmlspecialchars($row['email']) . '</td>
	                  <td>' . htmlspecialchars($row['telephone']) . '</td>
	                  <td>' . htmlspecialchars($row['company']) . '</td>
	                  <td>' . htmlspecialchars($row['assigned_to']) . '</td>
	                  </tr>';
	          }
	            echo '</tbody></table>';
	          ?>  
	</div>

<?php
	else:
	    echo "Contact not found.";
	endif;
?>

	</div>	

</body> 
</html>

