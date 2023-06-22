$(document).ready(function () {
    userList()

    $("form[name='addUserForm']").validate({
        rules: {

            firstname: "required",
            lastname: "required",
            role: "required",
            email: {
                required: true,
                email: true,
                remote: {
                    url: "/users/email-check",
                    data: {
                        hid: function () {
                            return $("#userId").val();
                        },
                    },
                },
            },
            password: {
                required: () => {
                    return !$("#userId").val()
                },
                minlength: 8
            }
        },
        messages: {
            firstname: "Please enter your firstname",
            role: "Please select Role",
            lastname: "Please enter your lastname",
            password: {
                required: "Please provide a password",
                minlength: "Your password must be at least 8 characters long"
            },
            email: {
                required: "Email is required",
                email: "Enter a valid email",
                remote: "That email address is already exists.",
            },
        },

        submitHandler: function (form) {
            showloader();
            $.ajax({
                url: "add_user",
                type: "POST",
                data: $("#addUserForm").serialize(),
                success: function (response) {
                    var data = JSON.parse(response);
                    if (data.status == 1) {
                        $("#addUserForm")[0].reset();
                        successMsg(data.message);
                        hideloader();
                        window.location.replace('/users');
                    } else {
                        hideloader();
                        errorMsg(data.message);
                    }
                },
            });


        }
    });

});

function userList() {

    $("#userTable").DataTable({
        processing: true,
        "bDestroy": true,
        "bAutoWidth": false,
        serverSide: true,
        ajax: {
            type: "POST",
            url: 'users',
            data: {
                "_token": $('meta[name="csrf-token"]').attr('content'),
            }
        },
        columns: [
            { data: "name", name: "name" },
            { data: "last_name", name: "last_name" },
            { data: "email", name: "email" },
            { data: "role", name: "role" },
            { data: "action", name: "action" },
        ],
        columnDefs: [
            {
                // targets: [4],
                // orderable: false,
                // defaultContent: "-",
                // targets: "_all"

            },
        ],
    });
}

function deleteUser(id) {
    $.ajax({
        url: "delete_user",
        type: "POST",
        data: {
            "_token": $('meta[name="csrf-token"]').attr('content'),
            id: id
        },
        success: function (response) {
            var data = JSON.parse(response);
            if (data.status == 1) {
                userList()
                successMsg(data.message);
                hideloader();
            } else {
                hideloader();
                errorMsg(data.message);
            }
        },
    });
}