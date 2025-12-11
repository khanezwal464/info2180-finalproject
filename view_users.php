<?php

  $host = 'localhost';
  $username = 'finalproj_user';
  $password = 'password123';
  $dbname = 'dolphin_crm';

  
  try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
      
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->query("SELECT firstname, lastname, email, role, date_time FROM users");

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
            $name = $row['firstname'] . ' ' . $row['lastname']
            echo '<tr>
                  <td>' . htmlspecialchars($name) . '</td>
                  <td>' . htmlspecialchars($row['email']) . '</td>
                  <td>' . htmlspecialchars($row['role']) . '</td>
                  <td>' . htmlspecialchars($row['date_time']) . '</td>
                  </tr>';
              }
                echo '</tbody></table>';
            } 
  
  } catch (PDOException $e) {
      die("Connection failed: " . $e->getMessage());
  }

?>

