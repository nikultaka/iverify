$(document).ready(function () {
    applicantList()
    let search = ''
    $.validator.addMethod(
        "validate_file_type",
        function (val, elem) {
            var files = $('#' + elem.id)[0].files;
            for (var i = 0; i < files.length; i++) {
                var fname = files[i].name.toLowerCase();
                var re = /(\.pdf|\.png|\.jpeg|\.jpg)$/i;
                if (!re.exec(fname)) {
                    return false;
                }
            }
            return true;
        },
        "Allowed Extentions are jpg , jpeg ,png , pdf"
    );

    $('input[type=radio][name=is_house_hold]').on('change', function () {
        if ($(this).val() == 'no') {
            $("#household_data").css("display", 'block');
        } else {
            $("#household_data").css("display", 'none');
        }
    });

    $('input[type=radio][name=is_dependant]').on('change', function () {
        if ($(this).val() == 'yes') {
            $("#dependant_data").css("display", 'block');
        } else {
            $("#dependant_data").css("display", 'none');
        }
    });

    $("form[name='applicationform']").validate({
        rules: {

            FirstName: "required",
            SecondName: "required",
            Surname: "required",
            Gender: "required",
            IDNumber: "required",
            dob: "required",
            merital_status: "required",
            is_house_hold: "required",

            household_first_name: {

                required: () => {
                    return $('input[type=radio][name=is_house_hold]').val() == 'no'
                }
            },

            household_last_name: {
                required: () => {
                    return $('input[type=radio][name=is_house_hold]').val() == 'no'
                }
            },


            household_relation: {
                required: () => {
                    return $('input[type=radio][name=is_house_hold]').val() == 'no'
                }
            },

            is_dependant: "required",

            dependant_first_name: {
                required: () => {
                    return $('input[type=radio][name=is_dependant]').val() == 'yes'
                }
            },

            dependant_last_name: {
                required: () => {
                    return $('input[type=radio][name=is_dependant]').val() == 'yes'
                }
            },

            dependant_relation: {
                required: () => {
                    return $('input[type=radio][name=is_dependant]').val() == 'yes'
                }
            },

            address: "required",
            Standtype: "required",
            wardnum: "required",
            town: "required",
            postalcode: "required",
            suburbs: "required",
            cellphone_number: "required",
            cellphone_number2: "required",
            work_tel_number: "required",
            // documnet: "required",
            'documnet[]': {
                required: $("#h_id").val() ? false : true,
                // extension: "jpg|jpeg|png|pdf"
                validate_file_type: true

            },
            sourceOfIncom: "required",
            employername: "required",
            department: "required",
            emplcontactn: "required",
            // flag: "required",
            Comments: "required",



        },
        messages: {
            FirstName: "Please enter your FirstName",
            SecondName: "Please enter your SecondName",
            Surname: "Please enter your Surname",
            Gender: "Please enter your Gender",
            IDNumber: "Please enter your IDNumber",
            dob: "Please enter your Date of birth",
            merital_status: "Please select Metirial Status",
            is_house_hold: "Please select is house hold",
            household_first_name: "Please enter your household FirstName",
            household_last_name: "Please enter your household LastName",
            household_relation: "Please enter your household Reletion",
            is_dependant: "Please select is dependant",
            dependant_first_name: "Please enter your dependant FirstName",
            dependant_last_name: "Please enter your dependant LastName",
            dependant_relation: "Please enter your dependant Reletion",
            address: "Please enter your address",
            Standtype: "Please enter your Standtype",
            wardnum: "Please enter your wardnum",
            town: "Please enter your town",
            postalcode: "Please enter your postalcode",
            suburbs: "Please enter your suburbs name",
            cellphone_number: "Please enter your Cellphone Number",
            cellphone_number2: "Please enter your Cellphone Number 2",
            work_tel_number: "Please enter your work Tel Number",
            // documnet: "Please upload your document",
            'documnet[]': {
                required: "Please upload atleast 1 File",
                // extension: "Allowed Extentions are jpg , jpeg ,png , pdf "
            },
            sourceOfIncom: "Please select source Of Incom",
            employername: "Please enter your employername",
            department: "Please enter your department",
            emplcontactn: "Please enter your employee Contect",
            flag: "Please enter your employee Contect",
            Comments: "Please enter Comments",


        },

        submitHandler: function (form) {
            var formData = new FormData($("#applicationform")[0]);

            showloader();
            $.ajax({
                url: "/upload_applicant",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: function (response) {
                    var data = JSON.parse(response);
                    if (data.status == 1) {
                        $("#applicationform")[0].reset();
                        successMsg(data.message);
                        hideloader();
                        window.location.replace('/show_applicant');
                    } else {
                        hideloader();
                        errorMsg(data.message);
                    }
                },
            });


        }
    });
    var table = $('#applicantTable').DataTable();

    $("input[type=search]").keyup(function () {
        if (!table.data().any()) {
            search = $(this).val()
        }
    });

    $('#add_applicant').on('click', function () {
        if (search) {

            window.location.replace('/add_applicant?search=' + search);
        } else {
            window.location.replace('/add_applicant');
        }
    })

});

function applicantList() {

    $("#applicantTable").DataTable({
        processing: true,
        "bDestroy": true,
        "bAutoWidth": false,
        serverSide: true,
        ajax: {
            type: "POST",
            url: 'show_applicant',
            data: {
                "_token": $('meta[name="csrf-token"]').attr('content'),
            }
        },
        columns: [
            { data: "FirstName", name: "FirstName" },
            { data: "SecondName", name: "SecondName" },
            { data: "Surname", name: "Surname" },
            { data: "IDNumber", name: "IDNumber" },
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

function deleteApplicant(id) {
    $.ajax({
        url: "deleteApplicant",
        type: "POST",
        data: {
            "_token": $('meta[name="csrf-token"]').attr('content'),
            id: id
        },
        success: function (response) {
            var data = JSON.parse(response);
            if (data.status == 1) {
                applicantList()
                successMsg(data.message);
                hideloader();
            } else {
                hideloader();
                errorMsg(data.message);
            }
        },
    });
}