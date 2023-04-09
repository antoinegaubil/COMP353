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
  <button id="add-row-btn" onclick="location.href='create.php?table=<?php echo $table; ?>'">Create new entry</button>
  <button id="home" onclick="location.href='index.php?'">
  <span>Back to Menu</span>
  <img id="bg-img" src="assets/bg.png">
  </button>
  
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
            <form method="post" action="edit.php?table=<?php echo $table;?>">
              <?php foreach ($row as $key => $value): ?>
                <input type="hidden" name="<?php echo $key; ?>" value="<?php echo $value; ?>">
              <?php endforeach; ?>
              <button type="submit">Edit</button>
            </form>
            <form method="post" action="delete.php?table=<?php echo $table;?>">
              <?php foreach ($row as $key => $value): ?>
                <input type="hidden" name="<?php echo $key; ?>" value="<?php echo $value; ?>">
              <?php endforeach; ?>
              <button type="submit">Remove</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</body>
</html>