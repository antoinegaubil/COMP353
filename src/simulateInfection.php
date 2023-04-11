<?php
require_once 'database.php';

$query = "SELECT * FROM Employees WHERE medcard NOT IN (SELECT medcard FROM IsInfected)";
$statement = $conn->prepare($query);
$statement->execute();
$data = $statement->fetch(PDO::FETCH_ASSOC);

if($data){


    echo "Medcard : " . $data['medcard'] . "<br>";
    echo "Name: " . $data['firstName'] . "<br>";

    echo "<br>";
    echo $data['firstName'] . ' is now infected.';

    //Getting all the facilities
    $queryFacil = "SELECT facilityID FROM WorksAt WHERE medcard =". $data['medcard'];
    $statement = $conn->prepare($queryFacil);
    $statement->execute();
    $facil_id = $statement->fetchAll(PDO::FETCH_ASSOC);

    foreach ($facil_id as $id) {
        $facilityID = $id['facilityID'];

        //getting facility name
        $queryFacilityName = "SELECT name FROM Facilities WHERE facilityID = ?";
        $statementFacilityName = $conn->prepare($queryFacilityName);
        $statementFacilityName->execute([$facilityID]); 
        $facilityName = $statementFacilityName->fetchColumn();

        $queryEmployees = "SELECT *
                            FROM Employees
                            WHERE medcard IN (
                                SELECT medcard
                                FROM WorksAt
                                WHERE facilityID = ?
                            )";
        $statementEmployees = $conn->prepare($queryEmployees);
        $statementEmployees->execute([$facilityID]);
        $employees = $statementEmployees->fetchAll(PDO::FETCH_ASSOC);
        foreach ($employees as $employee) {
       
            
            $subject = "Warning";
            $body = "One of your colleagues has been infected.";
            $emailQuery = "INSERT INTO log (sender, receiver, date, subject, body) VALUES (?, ?, CURRENT_DATE(), ?, ?)";
            $statement = $conn->prepare($emailQuery);
            $statement->execute([$facilityName, $employee['firstName'], $subject, $body]);
          
        }
    }

    $insertQuery = "INSERT INTO IsInfected (medcard, infectionID, dateOfInfection, occurence) VALUES (?, ?, ?, ?)";
    $insertStatement = $conn->prepare($insertQuery);
    $insertStatement->execute([$data['medcard'], 2, date('Y-m-d'), 1]);

}



?>
