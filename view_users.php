<?php require("data_base.php"); ?>

<!DOCTYPE html>
<html>
<head>
  
  <meta charset="utf-8">
	<title>Users List</title>

  <link href="view_users_styles.css" type="text/css" rel="stylesheet"/>
  
</head>
<body>

  <header>
    <h1>Dolphin CRM</h1>
  </header>

	<div class="container">
		<div class="sidebar">
			<?php include'dolph_nav.php';?>
		</div>


	<div class="table">
		<div class="t_header">
			<h2>Users</h2>
			<button onclick="window.location.href='add_user.php'">Add User</button>
		</div>

		<?php $stmt = $conn->query("SELECT firstname, lastname, email, role, date_time FROM users"); ?>

		<?php
	    echo '<table class="users">
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
	</div>	

</body> 
</html>
