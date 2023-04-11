<!DOCTYPE html>
<html>
<head>
    <title>Assign Schedule</title>
    <link rel="stylesheet" href="css/assign.css">
</head>
<body>
    <h1>Assign Schedule</h1>
    <form method="post">
        <label for="schedule">Select an Employee Medcard:</label>
        <select id="schedule" name="schedule">
            <?php
            
            require_once 'database.php';

            // Fetch employee medcard IDs from the employee table in the database
            $query = "SELECT medcard FROM Employees";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $medcardIDs = $stmt->fetchAll(PDO::FETCH_COLUMN);

            
            foreach ($medcardIDs as $medcardID) {
                echo "<option value=\"$medcardID\">$medcardID</option>";
            }
            ?>
        </select>
        <br>
        <input type="submit" name="display" value="Fetch employee info">
    </form>
    <form action="isAssignValid.php" method="post">
        <ul>
            <li>Facility ID <input type="text" name="facilityID"></li>
            <li>Start Date <input type="date" name="startDate"></li>
            <li>Start Time <input type="time" name="startTime"></li>
            <li>End Time <input type="time" name="endTime"></li>
            <li><input type="hidden" name="medcard" value="<?php if (isset($_POST['display'])) { echo $_POST['schedule'];} ?>"></li>
            <li><input type="submit" value="Assign"></li>
        </ul>

    </form>
    <div id="employee-info-container" style="margin-top: 20px;">
        <?php
        // Check if a medcard is selected and fetch employee information
        if (isset($_POST['display'])) {
            $selectedMedcard = $_POST['schedule'];
            $query = "SELECT * FROM Employees WHERE medcard = :medcardID";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':medcardID', $selectedMedcard);
            $stmt->execute();
            $employeeInfo = $stmt->fetch(PDO::FETCH_ASSOC);
            // Display employee information
            if ($employeeInfo) {
                echo "<h2>Employee Information</h2>";
                echo "Medcard ID: " . $employeeInfo['medcard'] . "<br>";
                echo "First Name: " . $employeeInfo['firstName'] . "<br>";
                echo "Last Name: " . $employeeInfo['lastName'] . "<br>";
                echo "Role: " . $employeeInfo['role'] . "<br>";
                // Display other employee information fields as needed
            }
        }
        ?>
    </div>
    <div id="worksAt-container" style="margin-top: 20px;">
        <?php
        // Check if a medcard is selected and fetch WorksAt table information
        if (isset($_POST['display'])) {
            $selectedMedcard = $_POST['schedule'];
            $query = "SELECT * FROM WorksAt WHERE medcard = :medcardID";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':medcardID', $selectedMedcard);
            $stmt->execute();
            $worksAtInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            // Display WorksAt information
            
            if ($worksAtInfo) {
                echo "<h2>WorksAt Information</h2>";
                foreach ($worksAtInfo as $row) {
                    echo "FacilityID: " . $row['facilityID'] . "<br>";
                    echo "Start Date: " . $row['startDate'] . "<br>";
                    echo "Termination Date: " . $row['endDate'] . "<br>";
                    echo "Work Hours: " . $row['startTime'] . " - " . $row['endTime'] ."<br>";
                    echo "<hr>"; // Add a horizontal line to separate each WorksAt row
                }
            } else {
                echo "No WorksAt information found for the selected medcard ID.";
            }
        }
        ?>
    </div>
</body>
</html>