<?php
require_once 'database.php';
$table = $_GET['table'];

$statement = $conn->prepare("SELECT * FROM hac353_4.$table");
$statement->execute();
$rows = $statement->fetchAll(PDO::FETCH_ASSOC);

$statement = $conn->prepare("DESCRIBE hac353_4.$table");
$statement->execute();
$columns = $statement->fetchAll(PDO::FETCH_COLUMN);
?>

<!DOCTYPE html>
<html>
<head>
	<title><?php echo $table; ?></title>
    <link rel="stylesheet" href="css/showTable.css">
</head>
<body>
  <h1><?php echo $table; ?></h1>
  <table>
    <thead>
      <tr>
        <?php foreach ($columns as $column): ?>
          <th><?php echo $column; ?></th>
        <?php endforeach; ?>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($rows as $row): ?>
        <tr>
          <?php foreach ($row as $value): ?>
            <td><?php echo $value; ?></td>
          <?php endforeach; ?>
          <td>
            <button>Edit</button>
            <button>Remove</button>
          </td>
          
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</body>
</html>