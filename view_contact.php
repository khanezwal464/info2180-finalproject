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
	
	//Collecting contact details
	$stmt = $conn->prepare("SELECT * FROM contacts WHERE email = :email"); 
	$stmt->execute(['email' => $email]); 
	$contact = $stmt->fetch(PDO::FETCH_ASSOC);

	//Collecting user who created the contact
	$userStmt = $conn->prepare("SELECT firstname, lastname FROM users WHERE id = :id"); 
	$userStmt->execute(['id' => $contact['created_by']]); 
	$creator = $userStmt->fetch(PDO::FETCH_ASSOC);

	//Collect user the contact is assigned to
	$assiStmt = $conn->prepare("SELECT firstname, lastname FROM users WHERE id = :id"); 
	$assiStmt->execute(['id' => $contact['assigned_to']]); 
	$assigned_user = $assiStmt->fetch(PDO::FETCH_ASSOC);

	//Collect notes for the contact 
	$noteStmt = $conn->prepare("SELECT * FROM notes WHERE contact_id = :contact_id"); 
	$noteStmt->execute(['contact_id' => $contact['id']]); 
	$notes = $noteStmt->fetchAll(PDO::FETCH_ASSOC);

	if ($contact)

	?>

  	<div class="contact_page">
	  
		<div class="header_details">
			<div class="contact_info">
				<div class="top_row">
					<h2><?= htmlspecialchars($contact['title']. ' ' . $contact['firstname'] . ' ' . $contact['lastname']) ?></h2>
				</div>
				
	            <p><strong>Created On:</strong> <?= htmlspecialchars($contact['created_at']) ?> <strong>by:</strong> <?= htmlspecialchars($creator['firstname'] . ' ' . $creator['lastname']); ?> </p>
	            <p><strong>Updated At:</strong> <?= htmlspecialchars($contact['updated_at']) ?></p>
			</div>
			
		  	<div class="buttons">
				<button id="assign" onclick="">Assign to me </button>
	      		<button id="switch" onclick="">Switch role</button>
			</div>
			
		</div>
	  
		<div class="other_details"> 
			<div class="detail_item"> 
				<label>Email</label> 
				<div><?= htmlspecialchars($contact['email']) ?></div> 
			</div>

			<div class="detail_item"> 
				<label>Telephone</label> 
				<div><?= htmlspecialchars($contact['telephone']) ?></div> 
			</div>

			<div class="detail_item"> 
				<label>Company</label> 
				<div><?= htmlspecialchars($contact['company']) ?></div> 
			</div>

			<div class="detail_item"> 
				<label>Assigned to</label> 
				<div><?= htmlspecialchars($assigned_user['firstname'] . ' ' . $assigned_user['lastname']) ?></div> 
			</div>
		</div>

		<div class="notes">
			<h3>Notes</h3>

			<?php if (empty($notes)): ?> 
				<p>No notes available for this contact.</p> 
			<?php else: ?>

				<?php foreach ($notes as $note): 

				//Collect creator of note
				$noteUserStmt = $conn->prepare("SELECT firstname, lastname FROM users WHERE id = :id"); 
				$noteUserStmt->execute(['id' => $note['created_by']]); 
				$note_creator = $noteUserStmt->fetch(PDO::FETCH_ASSOC);
				?>
		
				<div class="note_item"> 
					<label><?= htmlspecialchars($note_creator['firstname'] . ' ' . $note_creator['lastname']) ?></label> 
					<div><?= htmlspecialchars($note['comment']) ?></div> 
					<div><?= htmlspecialchars($note['created_at']) ?></div> 
				</div>
				<?php endforeach; ?> 
			
			<?php endif; ?>

			<div class="create_note">
				<p>Add a note for <?= htmlspecialchars($contact['firstname'] . ' ' . $contact['lastname']); ?></p>
				
				<div class="note_section">
					<form method="GET" action="">
						<input type="text" name="new_note" id="new_note" placeholder="Enter your text here">
						<button type="submit" id="submit">Submit</button>
					</form>
				</div>
				
			</div>
			
		</div>


		
	</div>	

</body> 
</html>

