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

    $stmt = $conn->query("SELECT firstname, lastname, email, role, date_time FROM users");

	} catch (PDOException $e) {
	  die("Connection failed: " . $e->getMessage());
}
	?>

  <div class="contact">
		<div class="details">
			
			<button onclick="">Assign</button>
      <button onclick="">Switch</button>
		</div>

		<?php
	    echo '<table class="details">
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
	</div>	

</body> 
</html>

