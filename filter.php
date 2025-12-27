<?php
session_start();

require "data_base.php";
include "function.php";

/*if(isset($_GET['filter'])){
    $query = strip_tags($_GET['filter']);
}

else{
    $query = '';
}*/

$query = isset($_GET['filter']) ? strip_tags($_GET['filter']) : '';

if($query == ''){
    /*$filt = "SELECT * from contacts";
    $result = mysqli_query($conn, $filt);
    $results = mysqli_fetch_all($result, MYSQLI_ASSOC);*/
    
    $stmt = $conn->query("SELECT * FROM contacts"); 
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

    <table id = "table">
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
    /*$filt = "SELECT * from contacts WHERE type LIKE ?";
    $query = "%".strip_tags($_GET['filter'])."%";
    $statement = $conn->prepare($filt);
    $statement ->bind_param("s",$query);
    $statement ->execute();
    $result = $statement ->get_result();
    $results = $result ->fetch_all(MYSQLI_ASSOC);?>*/

    $filter = "%".strip_tags($_GET['filter'])."%"; 
    $stmt = $conn->prepare("SELECT * FROM contacts WHERE type LIKE ?"); 
    $stmt->execute([$filter]); 
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
    <table>
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
    /*$sess = strip_tags($_SESSION['id']);
    $filt = "SELECT * from contacts WHERE contacts.assigned_to = ?";

    $statement = $conn->prepare($filt);
    $statement ->bind_param("s",$sess);
    $statement ->execute();
    $result = $statement ->get_result();
    $results = $result ->fetch_all(MYSQLI_ASSOC);?>*/

    $sess = $_SESSION['id']; 
    $stmt = $conn->prepare("SELECT * FROM contacts WHERE assigned_to = ?"); 
    $stmt->execute([$sess]); 
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
    <table>
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
