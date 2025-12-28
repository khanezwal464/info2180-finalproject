<?php
session_start();

require "data_base.php";
include "function.php";

$query = isset($_GET['filter']) ? strip_tags($_GET['filter']) : '';

if($query == ''){
    
    $stmt = $conn->query("SELECT * FROM contacts"); 
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

    <table class = "table">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Company</th>
            <th>Type</th>
            <th></th>
        </tr>
        
    <?php if($results != null): ?>
         <?php foreach($results as $row): ?>
            <tr class = "row">
                <td><strong><?=htmlspecialchars($row['title']." ".$row['firstname']." ".$row['lastname'])?></strong></td>
                <td class = "email"><?=htmlspecialchars($row['email'])?></td>
                <td><?=htmlspecialchars($row['company'])?></td>
                <td class= "type"><?=htmlspecialchars($row['type'])?></td>
                <td class = "link">
                    <a href="view_contact.php?email=<?= $row['email'] ?>">View</a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
    </table>

<?php 
} elseif($query == 'Sales'|| $query == 'Support'){ 

    $filter = "%".strip_tags($_GET['filter'])."%"; 
    $stmt = $conn->prepare("SELECT * FROM contacts WHERE type LIKE ?"); 
    $stmt->execute([$filter]); 
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
    <table class = "table">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Company</th>
            <th>Type</th>
            <th></th>
        </tr>
        
    <?php if($results != null): ?>
        <?php foreach($results as $row): ?>
            <tr class = "row">
                <td><strong><?=htmlspecialchars($row['title']." ".$row['firstname']." ".$row['lastname'])?></strong></td>
                <td class = "email"><?=htmlspecialchars($row['email'])?></td>
                <td><?=htmlspecialchars($row['company'])?></td>
                <td class= "type"><?=htmlspecialchars($row['type'])?></td>
                <td class = "link">
                    <a href="view_contact.php?email=<?= $row['email'] ?>">View</a>
                </td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
    </table>
        
<?php
} elseif($query == 'Assigned'){
    
    $sess = $_SESSION['id']; 
    $stmt = $conn->prepare("SELECT * FROM contacts WHERE assigned_to = ?"); 
    $stmt->execute([$sess]); 
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
    <table class = "table">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Company</th>
            <th>Type</th>
            <th></th>
        </tr>
        
    <?php if($results != null): ?>
        <?php foreach($results as $row): ?>
            <tr class = "row">
                <td><strong><?=htmlspecialchars($row['title']." ".$row['firstname']." ".$row['lastname'])?></strong></td>
                <td class = "email"><?=htmlspecialchars($row['email'])?></td>
                <td><?=htmlspecialchars($row['company'])?></td>
                <td class= "type"><?=htmlspecialchars($row['type'])?></td>
                <td class = "link">
                    <a href="view_contact.php?email=<?= $row['email'] ?>">View</a>
                </td>
            </tr>
        <?php endforeach; ?>
      <?php endif; ?>
    </table>
    
<?php 
}
?>
