<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // Connect to database
    require_once('db.php');
    
    $id = $_POST["id"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $department = $_POST["department"];
    
    try {
        $query = "UPDATE employees SET name=?, email=?, department_id=? WHERE id=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssii", $name, $email, $department, $id);
        $stmt->execute();
    
        // Fetch updated record
        $query = "SELECT employees.id, employees.name, employees.email, departments.name AS department_name FROM employees INNER JOIN departments ON employees.department_id = departments.id WHERE employees.id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $employee = $result->fetch_assoc();
        echo json_encode($employee);
    
        $stmt->close();
    } catch (Exception $e) {
        echo json_encode(false);
    }
    
    $conn->close();
    