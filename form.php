<div class="form-group">
    <label for="department">Department</label>
    <select class="form-control" id="department" name="department" required>
        <option value="">Select Department</option>
        <?php
        // Connect to database
        $mysqli = new mysqli("localhost", "root", "", "bee_farm");

        // Check connection
        if ($mysqli->connect_errno) {
            echo "Failed to connect to MySQL: " . $mysqli->connect_error;
            exit();
        }

        // Query to retrieve departments
        $departmentsQuery = "SELECT * FROM departments";

        // Execute query
        $departmentsResult = $mysqli->query($departmentsQuery);

        // Loop through departments and create options
        if ($departmentsResult->num_rows > 0) {
            while ($department = $departmentsResult->fetch_assoc()) {
                echo "<option value=\"" . $department["id"] . "\">" . $department["name"] . "</option>";
            }
        }

        // Close database connection
        $mysqli->close();
        ?>
    </select>
</div>