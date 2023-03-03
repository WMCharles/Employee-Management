<?php
    require_once('db.php');
    // Get employee ID from POST data
    $id = $_POST["id"];


    // Prepare query
    $query = "DELETE FROM employees WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);

    // Execute query
    $stmt->execute();

    // Check for errors
    if ($stmt->error) {
        echo "Error: " . $stmt->error;
    } else {
        echo "Employee deleted successfully";
    }

    // Close database connection
    $stmt->close();
    $conn->close();
?>
