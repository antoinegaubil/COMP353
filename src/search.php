<?php
require_once 'database.php';
if (isset($_GET['table'], $_GET['column'], $_GET['value'])) {
    $table = $_GET['table'];
    $column = $_GET['column'];
    $value = $_GET['value'];

    $statement = $conn->prepare("SELECT * FROM hac353_4.$table WHERE $column = '$value'");
    $statement->execute();
    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
    
    $statement = $conn->prepare("DESCRIBE hac353_4.$table");
    $statement->execute();
    $columns = $statement->fetchAll(PDO::FETCH_COLUMN);
} 
else 
{}
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
            <h1>Search Table and Column</h1>
            <form action="search.php" method="GET">
                <label for="table">Select a table:</label>
                <select name="table" id="table">
                    <option value="-" selected>-</option>
                    <option value="Employees">Employees</option>
                    <option value="Facilities">Facilities</option>
                    <option value="Infections">Infections</option>
                    <option value="Vaccines">Vaccines</option>
                </select>

                <label for="column">Select a column:</label>
                <select name="column" id="column">
                    <option value="-" selected>-</option>

                    <optgroup id="none-options"></optgroup>

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
                        <option value="Actions">Actions</option>
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
                        <option value="Actions">Actions</option>
                    </optgroup>

                    <optgroup id="infections-options">
                        <option value="infectionID">Infection ID</option>
                        <option value="type">Type</option>
                        <option value="Actions">Actions</option>
                    </optgroup>

                    <optgroup id="vaccines-options">
                        <option value="vaccineID">Vaccine ID</option>
                        <option value="type">Type</option>
                        <option value="Actions">Actions</option>
                    </optgroup>
                </select>

                <label for="value">with value</label>
                <input type="text" name="value" id="value">

                <input type="submit" value="Search">
            </form>
        </div>
    </div>
</body>

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
        document.getElementById("column").value = "-";

        employeesOptions.style.display = "none";
        facilitiesOptions.style.display = "none";
        infectionsOptions.style.display = "none";
        vaccinesOptions.style.display = "none";

        var selectedTable = this.value;

        if (selectedTable === "Employees") {
            employeesOptions.style.display = "block";
        } else if (selectedTable === "Facilities") {
            facilitiesOptions.style.display = "block";
        } else if (selectedTable === "Infections") {
            infectionsOptions.style.display = "block";
        } else if (selectedTable === "Vaccines") {
            vaccinesOptions.style.display = "block";
        } else {noneOptions.style.display = "none";}
    });

