<!DOCTYPE html>
<html>
<head>
  
  <meta charset="utf-8">
	<title>Users List</title>

  <link href="view_users.css" type="text/css" rel="stylesheet"/>
	<script src="view_users.js" type="text/javascript"></script>
  
</head>
<body>

  <header>
    <h1>Dolphin CRM</h1>
  </header>

	<div id="sidebar">
		<a link href="">Home</a>
		<a link href="">New Contact</a>
		<a link href="">Users</a>
		<a link href="">Logout</a>
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

	  
	<!DOCTYPE html>
	<html>
	<body>

	<div id="table">
		<h2>Users</h2>
		<button id="adduser">Add User</button>

		<?php
	    echo '<table class="userlookup">
	          <thead>
	          <tr>
	          <th>Name</th>
	          <th>Email</th>
	          <th>Role</th>
	          <th>Created</th>
	          </tr>
	          </thead>
	          <tbody>';
	          
	          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
	            $name = $row['firstname'] . ' ' . $row['lastname'];
	            echo '<tr>
	                  <td>' . htmlspecialchars($name) . '</td>
	                  <td>' . htmlspecialchars($row['email']) . '</td>
	                  <td>' . htmlspecialchars($row['role']) . '</td>
	                  <td>' . htmlspecialchars($row['date_time']) . '</td>
	                  </tr>';
	          }
	            echo '</tbody></table>';
	          ?>  
	</div>
		

</body>
  
</html>
