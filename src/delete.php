<?php
require_once 'database.php';

$table = $_GET['table'];
// Get the primary key value from the $_POST array
$primary_key_name = array_key_first($_POST);
$primary_key_val = $_POST[$primary_key_name];

// Construct a DELETE SQL statement using the primary key value
$sql = "DELETE FROM $table WHERE $primary_key_name = $primary_key_val";

// Prepare the statement
$stmt = $conn->prepare($sql);


// Execute the statement
if ($stmt->execute()) {
    echo "Row deleted successfully";
} else {
    echo "Error deleting row";
}
if (strpos($_SERVER['HTTP_REFERER'], 'schedule.php') == true) {
  
    header("Location: schedule.php");
    exit; 
} else {
    header("Location: showTable.php?table=$table");
    exit; 
}
?>