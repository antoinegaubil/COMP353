<?php
require_once 'database.php';
$table = $_GET['table'];

$statement = $conn->prepare("DESCRIBE hac353_4.$table");
$statement->execute();
$columns = $statement->fetchAll(PDO::FETCH_COLUMN);



if (isset($_POST['create-button'])) {
    $data = $_POST;
    unset($data['create-button']);
    // prepare the update query
    $columns = implode(", ", array_keys($data));
    $values = ":" . implode(", :", array_keys($data));
    $query = "INSERT INTO hac353_4.$table ($columns) VALUES ($values)";
    $statement = $conn->prepare($query);
    
    // Bind the form data to the prepared statement and execute it
    foreach ($data as $key => $value) {
        $statement->bindValue(":$key", $value);
    }
    $statement->execute();
    header("Location: showTable.php?table=$table");
    exit();
    
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Create new entry for <?php echo $table; ?></title>
	<link rel="stylesheet" href="css/create.css">
</head>
<body>
	<h1>Create new entry for <?php echo $table; ?></h1>
	<form method="post" >
		<?php foreach ($columns as $column): ?>
			<label for="<?php echo $column; ?>"><?php echo $column; ?>:</label>
			<input type="text" name="<?php echo $column; ?>" id="<?php echo $column; ?>">
			<br>
		<?php endforeach; ?>
		<button type="submit" name="create-button">Create</button>
	</form>
</body>
</html>