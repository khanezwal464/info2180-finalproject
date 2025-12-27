<?php 
require 'data_base.php';

	/*Saves new note to database 
	if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['new_note'])) { 
		$stmt = $conn->prepare(" INSERT INTO notes (contact_id, created_by, comment, created_at) VALUES (:contact_id, :created_by, :comment, NOW()) "); 
		$stmt->execute([ 'contact_id' => $_POST['contact_id'], 'created_by' => $_SESSION['user_id'], 'comment' => $_POST['new_note'] ]); 
		
		// Redirect to avoid resubmitting on refresh 
		header("Location: contact.php?id=" . $_POST['contact_id']); 
		exit; 
	}*/

	//Switches contact's role
	if ($_SERVER['REQUEST_METHOD'] === 'POST') { 

		if ($_POST['action'] === 'switch') {
			$stmt = $conn->prepare("SELECT type FROM contacts WHERE id = :id"); 
			$stmt->execute(['id' => $_POST['contact_id']]); 
			$currentRole = $stmt->fetchColumn();

			$newRole = ($currentRole === 'Sales Lead') ? 'Support' : 'Sales Lead';

			$stmt = $conn->prepare(" UPDATE contacts SET type = :type WHERE id = :contact_id "); 
			$stmt->execute(['type' => $newRole, 'contact_id' => $_POST['contact_id'] ]);

			//Allows updated info to be reflected upon refresh
			header("Location: view_contact.php?email=". urlencode($_POST['email']));
			exit;

		}

	}

	//GET request + user input sanitisation
	$email = isset($_GET['email']) ? filter_var($_GET['email'], FILTER_SANITIZE_EMAIL) : null;

	//Collecting contact details
	$stmt = $conn->prepare("SELECT * FROM contacts WHERE email = :email"); 
	$stmt->execute(['email' => $email]); 
	$contact = $stmt->fetch(PDO::FETCH_ASSOC);

	//To display opposite role on switch button
	$currentRole = $contact['type']; 
	$oppositeRole = ($currentRole === 'Sales Lead') ? 'Support' : 'Sales Lead';


?>


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
				<?php echo "<pre>DEBUG: Current role = " . htmlspecialchars($contact['type']) . "</pre>"; ?>
				<form method="POST">
					<input type="hidden" name="contact_id" value="<?= $contact['id'] ?>">
					<input type="hidden" name="email" value="<?= $contact['email'] ?>">
					<button id="assign" name="action" value="assign">Assign to me</button>
		      		<button id="switch" name="action" value="switch">Switch to <?= htmlspecialchars($oppositeRole) ?> </button>
				</form>
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
					<form method="POST">
						<textarea type="text" name="new_note" id="new_note" placeholder="Enter your text here"></textarea>
						<input type="hidden" name="contact_id" value="<?= $contact['id'] ?>"> <!-- Ensures note is added to correct contact -->
						<button type="submit" id="submit">Submit</button>
					</form>
				</div>
				
			</div>
			
		</div>


		
	</div>	

</body> 
</html>
