$(document).ready(function () {
    $('#ok').on("click", function () {
        var folder_name = ($('#folder_name').val()) ? $('#folder_name').val() : ""
        var path = ($('#path').val()) ? $('#path').val() : ""

        if (folder_name === "") {
            alert("folder_name kosong")
            return
        }

        if (path === "") {
            alert("path kosong")
            return
        }

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "http://localhost:8000/upload",
            type: "POST",
            data: {
                folder_name, path
            },
            success: function (response) {
                console.log(response);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });
});