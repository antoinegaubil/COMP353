<?php
require_once 'database.php';


$isPrimaryKey_input = true;
// get the table name from the URL parameter
$table = $_GET['table'];
if (isset($_POST['update-button'])) {
// prepare the update query
$update_query = "UPDATE $table SET ";
$isPrimaryKey = true;
$pkey = '';
$pval = '';
foreach ($_POST as $key => $value) {
    if($isPrimaryKey){
        $isPrimaryKey = false; //skipping editing the primary key (first input)
        $pkey = $key;
        $pval = $value;
        continue;
    }
    if (strpos($key, 'update-button') === 0) {
        // excluding the post value from button
        continue;
    }
    //excluding empty strings
    if($value == ''){
        continue;
    }
   
    //error with empty string so we need to convert to null
    $update_query .= "$key = '$value', ";
}
// remove the last comma and space from the query
$update_query = substr($update_query, 0, -2);
$update_query .= " WHERE $pkey = '$pval'";

// execute the update query

try {
    $conn->query($update_query);
    echo "Record updated successfully";
} catch (PDOException $e) {
    echo "Error updating record: " . $e->getMessage();
}

if ($table  == 'WorksAt') {
    header("Location: schedule.php");
    exit; 
} else {
    header("Location: showTable.php?table=$table");
    exit; 
}

}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Edit <?php echo $table; ?></title>
    <link rel="stylesheet" href="css/edit.css">
</head>
<body>
  <h1>Edit <?php echo $table?> </h1>
  <form method="post" >
    <?php foreach ($_POST as $key => $value): ?>
        <label><?php echo $key; ?></label>
        <input type="text" name="<?php echo $key; ?>" value="<?php echo $value; ?>" <?php if ($isPrimaryKey_input): ?>disabled<?php endif; ?>>
        <?php $isPrimaryKey_input = false; ?>
    <?php endforeach; ?>
    <button type="submit" name="update-button">Update</button>
  </form>
</body>
</html>