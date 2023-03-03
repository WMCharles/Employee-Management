$(document).ready(function () {
    // Handle add employee form submission
    $("#addEmployeeForm").submit(function (event) {
        event.preventDefault();
        var name = $("#addName").val();
        var email = $("#addEmail").val();
        var department = $("#addDepartment").val();
        $.ajax({
            url: "add_employee.php",
            method: "POST",
            data: {
                name: name,
                email: email,
                department: department
            },
            success: function (data) {
                // Reload table
                $("#employeeTable tbody").html(data);
                // Hide modal
                $("#addEmployeeModal").modal("hide");
                // Clear form
                $("#addEmployeeForm")[0].reset();
            }
        });
    });
    
    // Handle edit employee button click
    $(".editEmployeeButton").click(function () {
        var id = $(this).data("id");
        $.ajax({
            url: "get_employee.php",
            method: "POST",
            data: {
                id: id
            },
            success: function (data) {
                var employee = JSON.parse(data);
                $("#editId").val(employee.id);
                $("#editName").val(employee.name);
                $("#editEmail").val(employee.email);
                $("#editDepartment").val(employee.department_id);
            }
        });
    });

    // Handle edit employee form submission
    $("#editEmployeeForm").submit(function (event) {
        event.preventDefault();
        var id = $("#editId").val();
        var name = $("#editName").val();
        var email = $("#editEmail").val();
        var department = $("#editDepartment").val();
        $.ajax({
            url: "edit_employee.php",
            method: "POST",
            data: {
                id: id,
                name: name,
                email: email,
                department: department
            },
            success: function (data) {
                // Reload table
                $("#employeeTable tbody").html(data);
                // Hide modal
                $("#editEmployeeModal").modal("hide");
            }
        });
    });

    // Handle delete employee button click
    $(".deleteEmployeeButton").click(function () {
        var id = $(this).data("id");
        if (confirm("Are you sure you want to delete this employee?")) {
            $.ajax({
                url: "delete_employee.php",
                method: "POST",
                data: {
                    id: id
                },
                success: function (data) {
                    // Reload table
                    $("#employeeTable tbody").html(data);
                }
            });
        }
    });
});