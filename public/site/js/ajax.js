// --------------------------- general functions -------------

function displayValidation(errors) {
    $.each(errors, function (key, error) {
        var input = $("input[name='" + key + "']"),
            validation = `<span class="invalid-feedback" role="alert">
                                        <strong>` + error[0] + `</strong>
                                    </span>`;
        input.addClass('is-invalid');
        input.parent('.form-group').append(validation);
    })
}

function removeValidation() {
    $('div input[name]').each(function () {
        var inputName = $(this).attr('name'),
            input = $("input[name='" + inputName + "']"),
            parentDiv = input.parent('.form-group');

        // remove old validation before submit
        input.removeClass('is-invalid');
        parentDiv.find('.invalid-feedback').remove();
    });
}

function swalSuccess(data) {
    swal({
        title: 'Good !',
        text: data.message,
        icon: 'success',
        timer: '5000',
        buttons: false,
    })
}

function swalError(data) {
    if (data) {
        data = data.message;
    }
    data = data || 'Something Went Wrong';
    swal({
        title: 'Sorry',
        text: data,
        icon: 'error',
        timer: '8000',
        buttons: false,
    })
}

// --------------------------- login form -------------

$(document).on('submit', '#custom-login-form', function () {
    event.preventDefault();
    var form = $(this),
        url = $(this).attr('action');
    removeValidation();
    if (url) {
        $.ajax({
            url: url,
            method: 'POST',
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function (data) {
                if (data.code !== 204) {
                    window.location.replace(data.data);
                } else {
                    swalError(data)
                }
            },
            error: function (request) {
                if (request.status === 422) {
                    displayValidation(request.responseJSON.errors);
                } else {
                    swalError()
                }
            }
        });
    }
});

// --------------------------- register form -------------

$(document).on('submit', '#custom-register-form', function () {
    event.preventDefault();
    var form = $(this),
        url = $(this).attr('action');
    removeValidation();
    if (url) {
        $.ajax({
            url: url,
            method: 'POST',
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function (data) {
                window.location.replace(data.data);
            },
            error: function (request) {
                if (request.status === 422) {
                    displayValidation(request.responseJSON.errors);
                } else {
                    swalError()
                }
            }
        });
    }
});