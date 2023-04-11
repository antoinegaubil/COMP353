<?php
require_once 'database.php';

$columns = [];
$rows = [];
$value = [];
$value2 = [];
$value3 = [];
$table = '';
$table2 = '';

if (isset($_GET['table'], $_GET['column'], $_GET['value']) && $_GET['table2'] == '-' && $_GET['column2'] == '-' && $_GET['value2'] == '') {
    $table = $_GET['table'];
    $column = $_GET['column'];
    $value = $_GET['value'];
    $statement = $conn->prepare("SELECT * FROM hac353_4.$table WHERE $column = '$value'");
    $statement->execute();
    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);

    $query = "SELECT * FROM hac353_4.$table WHERE $column = '$value'";

    error_log($query);

    $statement = $conn->prepare("DESCRIBE hac353_4.$table");
    $statement->execute();
    $columns = $statement->fetchAll(PDO::FETCH_COLUMN);
}
elseif (isset($_GET['table'], $_GET['column'], $_GET['column2'], $_GET['value'], $_GET['value2']) && $_GET['table2'] == '-' && $_GET['column'] != '-' && $_GET['column2'] != '-' && $_GET['value'] != '' && $_GET['value2'] != '') {
  $table = $_GET['table'];
  $column = $_GET['column'];
  $column2 = $_GET['column2'];
  $value = $_GET['value'];
  $value2 = $_GET['value2'];

  error_log("HERE IN THE SECOND");
  
  $statement = $conn->prepare("SELECT * FROM hac353_4.$table WHERE $column = '$value' and $column2 = '$value2'");
  $statement->execute();
  $rows = $statement->fetchAll(PDO::FETCH_ASSOC);

  $statement = $conn->prepare("DESCRIBE hac353_4.$table");
  $statement->execute();
  $columns = $statement->fetchAll(PDO::FETCH_COLUMN);

}
elseif (isset($_GET['table'], $_GET['table2'], $_GET['column'], $_GET['column3'], $_GET['value'], $_GET['value3']) && $_GET['table'] != '-' && $_GET['table2'] != '-' && $_GET['column'] != '-' && $_GET['column3'] != '-' && $_GET['value'] != '' && $_GET['value3'] != ''){
  $table = $_GET['table'];
  $table2 = $_GET['table2'];
  $column = $_GET['column'];
  $column3 = $_GET['column3'];
  $value = $_GET['value'];
  $value3 = $_GET['value3'];

  $query = "SELECT e.* FROM hac353_4.$table e INNER JOIN hac353_4.$table2 i ON e.medcard = i.medcard WHERE i.$column3 = '$value3' and e.$column = '$value'";

  error_log($query);
  
  $statement = $conn->prepare("SELECT e.* FROM hac353_4.$table e INNER JOIN hac353_4.$table2 i ON e.medcard = i.medcard WHERE i.$column3 = '$value3' and e.$column = '$value'");
  $statement->execute();
  $rows = $statement->fetchAll(PDO::FETCH_ASSOC);

  $statement = $conn->prepare("DESCRIBE hac353_4.$table");
  $statement->execute();
  $columns = $statement->fetchAll(PDO::FETCH_COLUMN);
}

else {
  // code to execute if none of the above conditions are met
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Form</title>
        <link rel="stylesheet" href="css/search.css">
</head>
<body>
    <div class="card">



        <div class="card-body">
            <h1>THE SEARCH ENGINE</h1>
            <form action="search.php" method="GET">
                <label for="table">Select a table:</label>
                <select name="table" id="table">
                    <option value="-" selected>-</option>
                    <option value="Employees">Employees</option>
                    <option value="Facilities">Facilities</option>
                    <option value="Infections">Infections</option>
                    <option value="Vaccines">Vaccines</option>
                    <option value="TookVaccines">TookVaccines</option>
                    <option value="IsInfected">IsInfected</option>
                </select>

                <label for="column">Select a column:</label>
                <select name="column" id="column">
                    <option value="-" selected>-</option>

                    <optgroup id="employees-options">
                        <option value="medcard">Medcard</option>
                        <option value="role">Role</option>
                        <option value="phoneNumber">Phone Number</option>
                        <option value="city">City</option>
                        <option value="email">Email</option>
                        <option value="firstName">First Name</option>
                        <option value="lastName">Last Name</option>
                        <option value="dateOfBirth">Date of Birth</option>
                        <option value="citizenship">Citizenship</option>
                        <option value="postalCode">Postal Code</option>
                        <option value="province">Province</option>
                    </optgroup>

                    <optgroup id="facilities-options">
                        <option value="facilityID">Facility ID</option>
                        <option value="name">Name</option>
                        <option value="phoneNumber">Phone Number</option>
                        <option value="webAddress">Web Address</option>
                        <option value="maxCapacity">Max Capacity</option>
                        <option value="province">Province</option>
                        <option value="city">City</option>
                        <option value="postalCode">Postal Code</option>
                        <option value="address">Address</option>
                        <option value="type">Type</option>
                        <option value="currentCapacity">Current Capacity</option>
                    </optgroup>

                    <optgroup id="infections-options">
                        <option value="infectionID">Infection ID</option>
                        <option value="type">Type</option>
                    </optgroup>

                    <optgroup id="vaccines-options">
                        <option value="vaccineID">Vaccine ID</option>
                        <option value="type">Type</option>
                    </optgroup>
                    
                    <optgroup id="took-options">
                        <option value="medCard">medCard ID</option>
                        <option value="vaccineID">vaccineID</option>
                        <option value="doseNumber">doseNumber</option>
                        <option value="facilityID">facilityID</option>
                        <option value="date">date</option>
                    </optgroup>

                    <optgroup id="infected-options">
                        <option value="medCard">medCard ID</option>
                        <option value="infectionID">infectionID</option>
                        <option value="dateOfInfection">dateOfInfection</option>
                        <option value="occurence">occurence</option>
                    </optgroup>

                </select>




                <label for="value">with value</label>
                <input type="text" name="value" id="value">







                <div id="second">
                  <label for="column2">Select a column:</label>
                  <br>
                  <select name="column2" id="column2">
                    <option value="-" selected>-</option>
                    <optgroup id="employees2-options">
                      <option value="medcard">Medcard</option>
                      <option value="role">Role</option>
                      <option value="phoneNumber">Phone Number</option>
                      <option value="city">City</option>
                      <option value="email">Email</option>
                      <option value="firstName">First Name</option>
                      <option value="lastName">Last Name</option>
                      <option value="dateOfBirth">Date of Birth</option>
                      <option value="citizenship">Citizenship</option>
                      <option value="postalCode">Postal Code</option>
                      <option value="province">Province</option>
                    </optgroup>
                    <optgroup id="facilities2-options">
                      <option value="facilityID">Facility ID</option>
                      <option value="name">Name</option>
                      <option value="phoneNumber">Phone Number</option>
                      <option value="webAddress">Web Address</option>
                      <option value="maxCapacity">Max Capacity</option>
                      <option value="province">Province</option>
                      <option value="city">City</option>
                      <option value="postalCode">Postal Code</option>
                      <option value="address">Address</option>
                      <option value="type">Type</option>
                      <option value="currentCapacity">Current Capacity</option>
                    </optgroup>
                    <optgroup id="infections2-options">
                      <option value="infectionID">Infection ID</option>
                      <option value="type">Type</option>
                    </optgroup>
                    <optgroup id="vaccines2-options">
                      <option value="vaccineID">Vaccine ID</option>
                      <option value="type">Type</option>
                    </optgroup>
                    <optgroup id="took2-options">
                      <option value="medCard">medCard ID</option>
                      <option value="vaccineID">vaccineID</option>
                      <option value="doseNumber">doseNumber</option>
                      <option value="facilityID">facilityID</option>
                      <option value="date">date</option>
                    </optgroup>
                    <optgroup id="infected2-options">
                      <option value="medCard">medCard ID</option>
                      <option value="infectionID">infectionID</option>
                      <option value="dateOfInfection">dateOfInfection</option>
                      <option value="occurence">occurence</option>
                    </optgroup>
                  </select>
                  <br>
                  <label for="value2">with value</label>
                  <br>
                  <input type="text" name="value2" id="value2">
                </div>





                  <div id="secondtable">
                        <label for="table2">Select a table:</label>
                        <br>
                        <select name="table2" id="table2">
                            <option value="-" selected>-</option>
                            <option value="Employees">Employees</option>
                            <option value="Facilities">Facilities</option>
                            <option value="Infections">Infections</option>
                            <option value="Vaccines">Vaccines</option>
                            <option value="TookVaccines">TookVaccines</option>
                            <option value="IsInfected">IsInfected</option>
                        </select>
                        <br>
                        <label for="column3">Select a column:</label>
                        <br>
                        <select name="column3" id="column3">
                            <option value="-" selected>-</option>

                            <optgroup id="employees-options3">
                                <option value="medcard">Medcard</option>
                                <option value="role">Role</option>
                                <option value="phoneNumber">Phone Number</option>
                                <option value="city">City</option>
                                <option value="email">Email</option>
                                <option value="firstName">First Name</option>
                                <option value="lastName">Last Name</option>
                                <option value="dateOfBirth">Date of Birth</option>
                                <option value="citizenship">Citizenship</option>
                                <option value="postalCode">Postal Code</option>
                                <option value="province">Province</option>
                            </optgroup>

                            <optgroup id="facilities-options3">
                                <option value="facilityID">Facility ID</option>
                                <option value="name">Name</option>
                                <option value="phoneNumber">Phone Number</option>
                                <option value="webAddress">Web Address</option>
                                <option value="maxCapacity">Max Capacity</option>
                                <option value="province">Province</option>
                                <option value="city">City</option>
                                <option value="postalCode">Postal Code</option>
                                <option value="address">Address</option>
                                <option value="type">Type</option>
                                <option value="currentCapacity">Current Capacity</option>
                            </optgroup>

                            <optgroup id="infections-options3">
                                <option value="infectionID">Infection ID</option>
                                <option value="type">Type</option>
                            </optgroup>

                            <optgroup id="vaccines-options3">
                                <option value="vaccineID">Vaccine ID</option>
                                <option value="type">Type</option>
                            </optgroup>

                            <optgroup id="took-options3">
                                <option value="medCard">medCard ID</option>
                                <option value="vaccineID">vaccineID</option>
                                <option value="doseNumber">doseNumber</option>
                                <option value="facilityID">facilityID</option>
                                <option value="date">date</option>
                            </optgroup>

                            <optgroup id="infected-options3">
                                <option value="medCard">medCard ID</option>
                                <option value="infectionID">infectionID</option>
                                <option value="dateOfInfection">dateOfInfection</option>
                                <option value="occurence">occurence</option>
                            </optgroup>

                        </select>
                        <br>
                        <label for="value3">with value</label>
                        <br>
                        <input type="text" name="value3" id="value3">

                  </div>




                <input type="submit" value="Search">

                <div id = "buttons">
                   <button type="button" onclick="toggleColumn()">Add a Criteria</button>
                   <button type="button" onclick="toggleTable()">Join 2 Tables</button>
                </div>

            </form>
        </div>
    </div>
</body>

<body>
  <h2><?php echo $table; ?></h2>
  <table>
    <thead>
      <tr>
        <?php foreach ($columns as $column): ?>
          <th><?php echo $column; ?></th>
        <?php endforeach; ?>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($rows as $row): ?>
        <tr>
          <?php foreach ($row as $value): ?>
            <td><?php echo ($value == null || $value == '-') ? 'no data' : $value; ?></td>
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


    <script>

    document.getElementById("table").addEventListener("change", function() {
        
        
        var employeesOptions = document.getElementById("employees-options");
        var facilitiesOptions = document.getElementById("facilities-options");
        var infectionsOptions = document.getElementById("infections-options");
        var vaccinesOptions = document.getElementById("vaccines-options");
        var IsInfectedOptions = document.getElementById("infected-options");
        var TookVaccineOptions = document.getElementById("took-options");

        var employeesOptions2 = document.getElementById("employees2-options");
        var facilitiesOptions2 = document.getElementById("facilities2-options");
        var infectionsOptions2 = document.getElementById("infections2-options");
        var vaccinesOptions2 = document.getElementById("vaccines2-options");
        var IsInfectedOptions2 = document.getElementById("infected2-options");
        var TookVaccineOptions2 = document.getElementById("took2-options");


        document.getElementById("column").value = "-";
        document.getElementById("column2").value = "-";


        employeesOptions.style.display = "none";
        facilitiesOptions.style.display = "none";
        infectionsOptions.style.display = "none";
        vaccinesOptions.style.display = "none";
        IsInfectedOptions.style.display = "none";
        TookVaccineOptions.style.display = "none";

        employeesOptions2.style.display = "none";
        facilitiesOptions2.style.display = "none";
        infectionsOptions2.style.display = "none";
        vaccinesOptions2.style.display = "none";
        IsInfectedOptions2.style.display = "none";
        TookVaccineOptions2.style.display = "none";

        var selectedTable = this.value;

        if (selectedTable === "Employees") {
            employeesOptions.style.display = "block";
            employeesOptions2.style.display = "block";
        } else if (selectedTable === "Facilities") {
            facilitiesOptions.style.display = "block";
            facilitiesOptions2.style.display = "block";
        } else if (selectedTable === "Infections") {
            infectionsOptions.style.display = "block";
            infectionsOptions2.style.display = "block";
        } else if (selectedTable === "Vaccines") {
            vaccinesOptions.style.display = "block";
            vaccinesOptions2.style.display = "block";
        } else if (selectedTable === "IsInfected") {
            IsInfectedOptions.style.display = "block";
            IsInfectedOptions2.style.display = "block";
        } else if (selectedTable === "TookVaccines") {
            TookVaccineOptions.style.display = "block";
            TookVaccineOptions2.style.display = "block";
        } else{
          employeesOptions.style.display = "none";
          facilitiesOptions.style.display = "none";
          infectionsOptions.style.display = "none";
          vaccinesOptions.style.display = "none";
          IsInfectedOptions.style.display = "none";
          TookVaccineOptions.style.display = "none";
          employeesOptions2.style.display = "none";
          facilitiesOptions2.style.display = "none";
          infectionsOptions2.style.display = "none";
          vaccinesOptions2.style.display = "none";
          IsInfectedOptions2.style.display = "none";
          TookVaccineOptions2.style.display = "none";
        } 
    });


    document.getElementById("table2").addEventListener("change", function() {
        
        
        var employeesOptions3 = document.getElementById("employees-options3");
        var facilitiesOptions3 = document.getElementById("facilities-options3");
        var infectionsOptions3 = document.getElementById("infections-options3");
        var vaccinesOptions3 = document.getElementById("vaccines-options3");
        var IsInfectedOptions3 = document.getElementById("infected-options3");
        var TookVaccineOptions3 = document.getElementById("took-options3");

        document.getElementById("column3").value = "-";


        employeesOptions3.style.display = "none";
        facilitiesOptions3.style.display = "none";
        infectionsOptions3.style.display = "none";
        vaccinesOptions3.style.display = "none";
        IsInfectedOptions3.style.display = "none";
        TookVaccineOptions3.style.display = "none";

        var selectedTable = this.value;

        if (selectedTable === "Employees") {
            employeesOptions3.style.display = "block";
        } else if (selectedTable === "Facilities") {
            facilitiesOptions3.style.display = "block";
        } else if (selectedTable === "Infections") {
            infectionsOptions3.style.display = "block";
        } else if (selectedTable === "Vaccines") {
            vaccinesOptions3.style.display = "block";
        } else if (selectedTable === "IsInfected") {
            IsInfectedOptions3.style.display = "block";
        } else if (selectedTable === "TookVaccines") {
           TookVaccineOptions3.style.display = "block";
        } else{
          employeesOptions3.style.display = "none";
          facilitiesOptions3.style.display = "none";
          infectionsOptions3.style.display = "none";
          vaccinesOptions3.style.display = "none";
          IsInfectedOptions3.style.display = "none";
          TookVaccineOptions3.style.display = "none";

        } 
    });


    function toggleColumn() {
      var column2 = document.querySelector("#second");
      if (column2.style.display === "none") {
        column2.style.display = "block";
      } else {
        column2.style.display = "none";
      }
    }

    function toggleTable() {
      var column3 = document.querySelector("#secondtable");
      if (column3.style.display === "none") {
        column3.style.display = "block";
      } else {
        column3.style.display = "none";
      }
    }


    </script>