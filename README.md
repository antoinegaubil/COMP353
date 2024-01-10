# Database Management Web Application

## Project Overview

This project involves the development of a comprehensive database management web application. The application allows users to interact with a MySQL database using PHP-based web pages.
This PHP code connects to a MySQL database using PDO, retrieves all rows and column names for a specified table, enabling dynamic data display and manipulation in a PHP web app.

**Overview of The Database**

The database consists of tables representing various aspects of the system using mySQL. 
"Facilities" holds information about different locations, "Employees" stores personnel details, and "WorksAt" establishes employee-facility relationships. 
"Vaccines" and "Infections" track health-related data. "TookVaccines" and "IsInfected" link employees to vaccinations and infections. 
These tables collectively manage schedules, health data, and employee-facility associations.

**Constraints**

The relationships between entities are subject to constraints. Here are a few of them:

- Employees cannot work at a facility with current capacity >= max capacity.
- Employees cannot have conflicting work hours in two different schedules.
- If a doctor or nurse is infected, they cannot work for two weeks.
- Employees can have multiple vaccinations and infections.
- Employees can work at multiple facilities, provided there are no time conflicts.

## Implementation

The PHP code exemplifies the implementation of displaying a table. It dynamically fetches and shows the data, enabling users to create, edit, or delete entries. 
The user has access to a flexible search engine that enables specific value searches within individual tables and allows cross-table searches.


