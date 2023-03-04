<!DOCTYPE html>
<html>

<head>
    <title>Employee Management</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">

    <!-- js -->
    <script defer src="https://code.jquery.com/jquery-3.6.3.js"></script>
    <script defer src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
    <script defer src="https://cdn.datatables.net/1.13.3/js/dataTables.bootstrap4.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script defer src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script defer src="./assets/js/script.js"></script>
</head>

<body>
    <!-- Add Employee Modal -->
    <div class="modal fade" id="addEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="addEmployeeModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addEmployeeModalLabel">Add Employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addEmployeeForm">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
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
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" form="addEmployeeForm" class="btn btn-primary">Add Employee</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Employee Modal -->
    <div class="modal fade" id="editEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="editEmployeeModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editEmployeeModalLabel">Edit Employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editEmployeeForm">
                        <input type="hidden" id="editEmployeeId" name="id">
                        <div class="form-group">
                            <label for="editName">Name</label>
                            <input type="text" class="form-control" id="editName" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="editEmail">Email</label>
                            <input type="email" class="form-control" id="editEmail" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="editDepartment">Department</label>
                            <select class="form-control" id="editDepartment" name="department" required>
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
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" form="editEmployeeForm" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </div>
    </div>

    <div class="content mt-4">
        <h1 class="text-center mb-4">Employee Management</h1>
        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addEmployeeModal">Add Employee</button>
        <div class="table-responsive">
            <table class="table table-striped table-bordered" id="employeeTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Department</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Connect to database
                    $conn = new mysqli("localhost", "root", "", "bee_farm");

                    // Check connection
                    if ($conn->connect_errno) {
                        echo "Failed to connect to MySQL: " . $conn->connect_error;
                        exit();
                    }

                    // Query to retrieve employees with department names
                    $employeesQuery = "SELECT employees.id, employees.name, employees.email, departments.name AS department_name FROM employees LEFT JOIN departments ON employees.department_id = departments.id";

                    // Execute query
                    $employeesResult = $conn->query($employeesQuery);

                    // Loop through employees and create table rows
                    if ($employeesResult->num_rows > 0) {
                        while ($employee = $employeesResult->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $employee["id"] . "</td>";
                            echo "<td>" . $employee["name"] . "</td>";
                            echo "<td>" . $employee["email"] . "</td>";
                            echo "<td>" . $employee["department_name"] . "</td>";
                            echo "<td><button type=\"button\" class=\"btn btn-primary editEmployeeButton\" data-toggle=\"modal\" data-target=\"#editEmployeeModal\" data-id=\"" . $employee["id"] . "\">Edit</button> <button type=\"button\" class=\"btn btn-danger deleteEmployeeButton\" data-id=\"" . $employee["id"] . "\">Delete</button></td>";
                            echo "</tr>";
                        }
                    }
                    // Close database connection
                    $mysqli->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>