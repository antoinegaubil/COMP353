<?php
require_once 'database.php';

try {
    $query = "SELECT  Employees.firstName AS 'First Name' ,WorksAt.*
    FROM WorksAt 
    INNER JOIN Employees ON WorksAt.medcard = Employees.medcard 
    ORDER BY WorksAt.medcard";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die('Query failed: ' . $e->getMessage());
}


// Check if delete button is clicked
if(isset($_POST['delete'])) {
  
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Schedule Table</title>
    <link rel="stylesheet" href="css/schedule.css">
</head>
<body>
<h1>Schedule</h1>
  <button id="add-row-btn" onclick="location.href='assign.php'">Assign Schedule</button>
  <button id="home" onclick="location.href='index.php?'">
  <span>Back to Menu</span>
  <img id="bg-img" src="assets/bg.png">
  </button>
<table>
        <tr>
            <?php foreach ($rows[0] as $key => $value): ?>
                <th><?php echo $key; ?></th>
            <?php endforeach; ?>
            <th>Actions</th>
        </tr>
        <?php
            $current_medcard = null;
            foreach ($rows as $row):
                $medcard = $row['medCard'];
                if ($medcard == $current_medcard):
                    $class = 'similar-id';
                    $last_medcard_class = 'similar-id';
                else:
                    $class = '';
                endif;
                $current_medcard = $medcard; 
        ?>
            <tr class="<?php echo $class; ?>">
                <?php foreach ($row as $key => $value): ?>
                    <td><?php echo $value; ?></td>
                <?php endforeach; ?>
                <td>
                <form method="post" action="edit.php?table=WorksAt">
                        <?php foreach ($row as $key => $value): ?>
                            <input type="hidden" name="<?php echo $key; ?>" value="<?php echo $value; ?>">
                        <?php endforeach; ?>
                        <button class="edit-btn" type="submit" >EDIT</button>
                </form>
                <form method="post" action="delete.php?table=WorksAt">
                    <?php foreach ($row as $key => $value): ?>
                        <input type="hidden" name="<?php echo $key; ?>" value="<?php echo $value; ?>">
                    <?php endforeach; ?>
                    <button class="delete-btn" type="submit" >DELETE</button>
                </form>
                
            </td>
            </tr>
            
        <?php endforeach; ?>
    </table>
    </table>
</body>
</html>