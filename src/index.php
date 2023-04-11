<?php
require_once 'database.php';

$query = "SELECT * FROM log ORDER BY date DESC";
$statement = $conn->prepare($query);
$statement->execute();
$data = $statement->fetchAll(PDO::FETCH_ASSOC);




?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DB353 - Database UI</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <div id="menu">
        <h2>Tables</h2>
        <ul>
            <li><a class="table-link" href="showTable.php?table=Facilities" >Facilities</a></li>
            <li><a class="table-link" href="showTable.php?table=Employees">Employees</a></li>
            <li><a class="table-link" href="showTable.php?table=Vaccines">Vaccines</a></li>
            <li><a class="table-link" href="showTable.php?table=Infections">Infections</a></li>
            <li><a class="table-link" href="schedule.php">Schedules</a></li>
            <li>    <button id="search" onclick="location.href='search.php?'"> 
           
           Search
           <img id="search-img" src="assets/search-outline.svg">
           </button>
            </li>
        </ul>
    </div>
    <div id="content">
        <h1>DB353 - Database UI <img id="bg-img" src="assets/bg.png"></h1>
        
        <h2>Log Table</h2>
        <form method="post" action="simulateInfection.php">
            <input id="sim-btn" type="submit" value="Trigger Infection">
        </form>
        
    <div class="email-container">
    <?php
    foreach ($data as $el) {
        // Access the column data and populate the email elements
        $sender = $el['sender'];
        $receiver = $el['receiver'];
        $date = $el['date'];
        $subject = $el['subject'];
        $body = $el['body'];

        // Generate the email elements with the retrieved data
        echo '<div class="email">';
        echo '<div class="email-header">';
        echo '<div class="email-sender">From : ' . $sender . '</div>';
        echo '<div class="email-sender">To :' . $receiver . '</div>';
        echo '<div class="email-date">' . $date . '</div>';
        echo '<div class="email-subject">Subjet : ' . $subject . '</div>';
        echo '</div>';
        
        echo '<div class="email-body">' . $body . '</div>';
        echo '</div>';
    }
    ?>
    </div>
  
        
    </div>
 
</body>
</html>