<?php
session_start();

include "connection.php";
include "function.php";

if(isset($_GET['filter'])){
    $query = strip_tags($_GET['filter']);
}
else{
    $query = '';
}

if($query == ''){
    $filt = "SELECT * from Contacts";

    $result = mysqli_query($conn, $filt);

    $results = mysqli_fetch_all($result, MYSQLI_ASSOC);?>

    <table id = "table">
        
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Company</th>
            <th>Type</th>
            <th></th>
        </tr>
        
    <?php
    if($results != null){
         foreach($results as $row){?>
        <tr class = "row">
            <td><strong><?=htmlspecialchars($row['title']." ".$row['firstname']." ".$row['lastname'])?></strong></td>
            <td class = "email"><?=htmlspecialchars($row['email'])?></td>
            <td><?=htmlspecialchars($row['company'])?></td>
            <td class= "type"><?=htmlspecialchars($row['type'])?></td>
            <td class = "link">View</td>
        </tr>

    <?php }}?>

    </table>
<?php }

elseif($query == 'Sales'|| $query == 'Support'){
    $filt = "SELECT * from Contacts WHERE type LIKE ?";
    $query = "%".strip_tags($_GET['filter'])."%";
    $statement = $conn->prepare($filt);
    $statement ->bind_param("s",$query);
    $statement ->execute();
    $result = $statement ->get_result();
    $results = $result ->fetch_all(MYSQLI_ASSOC);?>

    <table>
        
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Company</th>
            <th>Type</th>
            <th></th>
        </tr>
        
    <?php 
    if($results != null){
        foreach($results as $row){?>
        <tr class = "row">
            <td><strong><?=htmlspecialchars($row['title']." ".$row['firstname']." ".$row['lastname'])?></strong></td>
            <td class = "email"><?=htmlspecialchars($row['email'])?></td>
            <td><?=htmlspecialchars($row['company'])?></td>
            <td class= "type"><?=htmlspecialchars($row['type'])?></td>
            <td class = "link">View</td>
        </tr>

    <?php }}?>

    </table>

<?php }

elseif($query == 'Assigned'){
    $sess = strip_tags($_SESSION['id']);
    $filt = "SELECT * from Contacts WHERE Contacts.assigned_to = ?";

    $statement = $conn->prepare($filt);
    $statement ->bind_param("s",$sess);
    $statement ->execute();
    $result = $statement ->get_result();
    $results = $result ->fetch_all(MYSQLI_ASSOC);?>

    <table>
        
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Company</th>
            <th>Type</th>
            <th></th>
        </tr>
        
    <?php 
    if($results != null){
        foreach($results as $row){?>
        <tr class = "row">
            <td><strong><?=htmlspecialchars($row['title']." ".$row['firstname']." ".$row['lastname'])?></strong></td>
            <td class = "email"><?=htmlspecialchars($row['email'])?></td>
            <td><?=htmlspecialchars($row['company'])?></td>
            <td class= "type"><?=htmlspecialchars($row['type'])?></td>
            <td class = "link">View</td>
        </tr>

    <?php }}?>

    </table>
    
<?php }