
function successMsg(msg) {
    toastr.options.progressBar = true;
    toastr.options.positionClass = "toast-top-center";
    toastr.success(msg).css("width", "400px");
}

function errorMsg(msg) {
    toastr.options.progressBar = true;
    toastr.options.positionClass = "toast-top-center";

    var check = Array.isArray(msg)
    if (check) {
        var msgs = "";
        $.each(msg, function (key, value) {
            msgs += value + '<br/>';
        });
        toastr.error(msgs).css("width", "400px");
    } else {
        toastr.error(msg).css("width", "400px");
    }
}

function warningMsg(msg) {
    toastr.options.progressBar = true;
    toastr.options.positionClass = "toast-top-center";
    toastr.warning(msg).css("width", "400px");
}

function infoMsg(msg) {
    toastr.options.progressBar = true;
    toastr.options.positionClass = "toast-top-center";
    var check = Array.isArray(msg)
    if (check) {
        var msgs = "";
        $.each(msg, function (key, value) {
            msgs += value + '<br/>';
        });
        toastr.info(msgs).css("width", "400px");
    } else {
        toastr.info(msg).css("width", "400px");
    }
}


function showloader() {
    $(".loader").css("display", "block !important;");
    $(".loader").show();
}
function hideloader() {
    $(".loader").css("display", "none;");
    $(".loader").hide();
}


// const inputDate = document.querySelector("input");

// inputDate.addEventListener("keydown", function (e) {
//   e.preventDefault();
// });