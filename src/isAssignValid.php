<?php

    require_once 'database.php';

    $facilityID = $_POST['facilityID'];
    $startDate = $_POST['startDate'];
    $startTime = $_POST['startTime'];
    $endTime = $_POST['endTime'];
    $medcard = $_POST['medcard'];
    
    // Fetch all the jobs the user is currently assigned to within the specified time range
    $query = "SELECT * FROM WorksAt WHERE medcard = :medcard 
    AND ((startTime <= :startTime AND endTime >= :startTime) OR 
        (startTime <= :endTime AND endTime >= :endTime))";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':medcard', $medcard);
    $stmt->bindParam(':startTime', $startTime);
    $stmt->bindParam(':endTime', $endTime);
    $stmt->execute();
    $jobs = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Check for time conflicts
    if (!empty($jobs)) {
    // There is a time conflict, handle accordingly (e.g., show error message)
    echo "Error: The user already has other jobs that conflict with the specified time range.";
    } else {
        $insertQuery = "INSERT INTO WorksAt (medcard, facilityID, startDate, startTime, endTime) 
        VALUES (:medcard, :facilityID, :startDate, :startTime, :endTime)";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bindParam(':medcard', $medcard);
        $stmt->bindParam(':facilityID', $facilityID);
        $stmt->bindParam(':startDate', $startDate);
        $stmt->bindParam(':startTime', $startTime);
        $stmt->bindParam(':endTime', $endTime);
        $stmt->execute();
}
header("Location: schedule.php");
?>