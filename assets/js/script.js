$(document).ready(function () {
    $('#employeeTable').DataTable();
    // Handle add employee form submission
    $("#addEmployeeForm").submit(function (event) {
        event.preventDefault();
        var name = $("#name").val();
        var email = $("#email").val();
        var department = $("#department").val();
        console.log(name, email, department);
        $.ajax({
            url: "add_employee.php",
            method: "POST",
            data: {
                name: name,
                email: email,
                department: department
            },
            dataType: "json",
            success: function (data) {
                location.reload();
            }
        });
    });

    // Handle edit employee button click
    $(".editEmployeeButton").click(function () {
        var employeeId = $(this).data("id");
        $.ajax({
            url: "get_employee.php",
            method: "GET",
            data: { id: employeeId },
            dataType: "json",
            contentType: "application/json",
            success: function (data) {

                var employee = data[0];

                // Populate edit modal form fields
                $("#editEmployeeId").val(employee.id);
                $("#editName").val(employee.name);
                $("#editEmail").val(employee.email);
                $("#editDepartment").val(employee.department_id);
                console.log(employee);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });

    // Handle edit employee form submission
    $("#editEmployeeForm").submit(function (event) {
        event.preventDefault();
        var id = $("#editEmployeeId").val();
        var name = $("#editName").val();
        var email = $("#editEmail").val();
        var department = $("#editDepartment").val();
        console.log(id)
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
                console.log(data);
                location.reload();
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
                    location.reload();
                }
            });
        }
    });

});



