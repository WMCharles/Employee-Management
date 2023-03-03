<?php
    // Connect to database
    require_once('db.php');

    // Get form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $department = $_POST["department"];

    // Prepare query
    $stmt = $conn->prepare("INSERT INTO employees (name, email, department_id) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $name, $email, $department);

    // Execute query
    if ($stmt->execute()) {
        // Get new employee data
        $result = $conn->query("SELECT employees.id, employees.name, employees.email, departments.name AS department_name FROM employees INNER JOIN departments ON employees.department_id = departments.id WHERE employees.id = LAST_INSERT_ID()");
        $employee = $result->fetch_assoc();
        // Return new employee data as JSON
        echo json_encode($employee);
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and database connection
    $stmt->close();
    $conn->close();
?>
