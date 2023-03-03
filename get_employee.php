<?php
    // Connect to database
    require_once('db.php');

    $id = $_GET["id"];
    // $id = 20;

    // Prepare query
    $query = "SELECT employees.id, employees.department_id, employees.name, employees.email, departments.name AS department_name FROM employees INNER JOIN departments ON employees.department_id = departments.id WHERE employees.id = $id";
    $result = $conn->query($query);

    // Create array to hold employee data
    $employees = array();

    // Loop through results and add each employee to array
    while ($row = $result->fetch_assoc()) {
        $employees[] = $row;
    }

    // Close database connection
    $conn->close();

    // Return employee data as JSON
    echo json_encode($employees);
