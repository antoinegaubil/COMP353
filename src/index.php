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
            <li>    <button id="search" onclick="location.href='search.php?'"> 
           
           Search
           <img id="search-img" src="assets/search-outline.svg">
           </button>
            </li>
        </ul>
    </div>
    <div id="content">
        <h1>DB353 - Database UI <img id="bg-img" src="assets/bg.png"></h1>       
  
        
    </div>
 
</body>
</html>