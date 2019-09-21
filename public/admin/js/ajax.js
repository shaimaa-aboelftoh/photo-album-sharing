// --------------------------- general functions -------------
$(function () {
    $('[data-toggle="tooltip"]').tooltip()
});

function displayValidation(errors) {
    $.each(errors, function (key, error) {
        var input,
            parentDiv,
            validation = `<span class="invalid-feedback" role="alert" style="display: block;">
                                        <strong>` + error[0] + `</strong>
                                    </span>`;

        if (key === 'type') {
            input = $("select[name='" + key + "']");
            input = input.parent('div');
            parentDiv = input.parent('.form-group');
        } else if (key === 'role_ids') {
            input = $("select[id='" + key + "']");
            input = input.parent('div');
            parentDiv = input.parent('.form-group');
        } else if (key === 'permission_ids') {
            input = $("input[name='" + key + "']");
            var container = input.parent('div').parent('div').parent('.row').parent('form');
            parentDiv = container.find('#permissions-validation');

        } else {
            input = $("input[name='" + key + "']");
            parentDiv = input.parent('.form-group');
        }

        parentDiv.addClass('has-danger');
        input.addClass('is-invalid');
        parentDiv.append(validation);
    })
}

function removeValidation() {
    $('div input[name]').each(function () {
        var inputName = $(this).attr('name'),
            input = $("input[name='" + inputName + "']"),
            parentDiv = input.parent('.form-group');

        // remove old validation before submit
        parentDiv.removeClass('focused');
        parentDiv.removeClass('has-danger');
        input.removeClass('is-invalid');
        parentDiv.find('.invalid-feedback').remove();
    });

    $('div select[name]').each(function () {
        var inputName = $(this).attr('name'),
            input = $("select[name='" + inputName + "']").parent('div'),
            parentDiv = input.parent('.form-group');
        // remove old validation before submit
        parentDiv.removeClass('focused');
        parentDiv.removeClass('has-danger');
        input.removeClass('is-invalid');
        parentDiv.find('.invalid-feedback').remove();
    });
}

function swalSuccess(data) {
    swal({
        title: 'Good !',
        text: data.message,
        icon: 'success',
        timer: '6000',
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

// --------------------------- profile form ------------------

$(document).on('submit', '#update-profile-form', function () {
    event.preventDefault();
    var form = $(this),
        url = $(this).attr('action'),
        name = $("input[name='name']").val(),
        submitBtn = $('#form-submit-btn');

    submitBtn.text("Please Wait...").prop('disabled', true);
    removeValidation();
    if (url) {
        $.ajax({
            url: url,
            method: 'POST',
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function (data) {
                swalSuccess(data);
                $('#page-title').text(name + ' Profile');
                $("#auth-user-name").text(name.substr(0, 15));
                submitBtn.text("Save Changes").prop('disabled', false);
            },
            error: function (request) {
                if (request.status === 422) {
                    displayValidation(request.responseJSON.errors);
                } else {
                    swalError()
                }
                submitBtn.text("Save Changes").prop('disabled', false);
            }
        });
    }
});

//---------------------------- create album form---------------------

$(document).on('submit', '#create-album-form', function () {
    event.preventDefault();
    var form = $(this),
        url = $(this).attr('action'),
        submitBtn = $('#form-submit-btn');

    submitBtn.text("Please Wait...").prop('disabled', true);

    removeValidation();
    if (url) {
        $.ajax({
            url: url,
            method: 'POST',
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function (data) {
                swalSuccess(data);
                form[0].reset();
                $(".selectpicker").selectpicker("refresh");
                submitBtn.text("Save").prop('disabled', false);
            },
            error: function (request) {
                if (request.status === 422) {
                    displayValidation(request.responseJSON.errors);
                } else {
                    swalError()
                }
                submitBtn.text("Save").prop('disabled', false);
            }
        });
    }
});


//---------------------------- update album form---------------------

$(document).on('submit', '#update-album-form', function () {
    event.preventDefault();
    var form = $(this),
        url = $(this).attr('action'),
        successURL = $(this).attr('data-load-after-ajax'),
        name = $('input[name="name"]').val(),
        submitBtn = $('#form-submit-btn');

    submitBtn.text("Please Wait...").prop('disabled', true);

    removeValidation();
    if (url) {
        $.ajax({
            url: url,
            method: 'POST',
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function (data) {
                swalSuccess(data);
                $('input[type="file"]').val('');
                $('.file').fileinput('reset');
                $('#page-title').html(name);
                submitBtn.text("Save Changes").prop('disabled', false);

                if (data.data.coverPath !== null) {
                    var coverNew = `<a href="` + data.data.coverPath + `">
                                        <img src="` + data.data.coverPath + `"
                                             alt="" class="show-img">
                                    </a>`;
                    $('#cover').html(coverNew);
                }

                if (data.data.imagesRefresh === true) {
                    $.ajax({
                        url: successURL,
                        type: 'GET',
                        data: {'_method': 'GET'},
                        success: function (data) {
                            if (data.status) {
                                $('#results').html(data.data);
                            }
                        },
                    })
                }
            },
            error: function (request) {
                if (request.status === 422) {
                    displayValidation(request.responseJSON.errors);
                } else {
                    swalError()
                }
                submitBtn.text("Save Changes").prop('disabled', false);
            }
        });
    }
});

//---------------------------- delete item ---------------------

$(document).on('click', '.delete-item', function () {
    event.preventDefault();
    var item = $(this),
        deleteURL = item.attr('deleteURL'),
        renderURL = item.attr('renderURL'),
        renderType = item.attr('renderType') || 'datatable';
    token = $('meta[name="csrf-token"]').attr('content'),
        dataTable = $(".dataTable");
    if (deleteURL) {
        swal({
            title: 'Are You Sure?',
            text: 'Once Deleted, You Will Not Be Able to Recover This Data !',
            icon: 'warning',
            buttons: ['Cancel', 'Continue & Delete !'],
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: deleteURL,
                        type: 'POST',
                        data: {
                            '_method': 'POST',
                            '_token': token,
                        },
                        success: function (data) {
                            if (data.status) {
                                swalSuccess(data);
                                $.ajax({
                                    url: renderURL,
                                    type: 'GET',
                                    data: {'_method': 'GET'},
                                    success: function (data) {
                                        if (data.status) {
                                            if (renderType === 'datatable') {
                                                dataTable.dataTable().fnDestroy()
                                                $('#results').html(data.data);
                                                dataTable.dataTable();
                                            } else {
                                                $('#results').html(data.data);
                                            }
                                        }
                                    },
                                })
                            } else {
                                swalError(data)
                            }
                        },
                        error: function () {
                            swalError();
                        }
                    })
                } else {
                    swal({
                        title: 'Good !',
                        text: 'Your Data is Safe!',
                        icon: 'info',
                        timer: '6000',
                        buttons: false,
                    });
                }
            });
    }
});

//---------------------------- create role form---------------------

$(document).on('submit', '#create-role-form', function () {
    event.preventDefault();
    var form = $(this),
        url = $(this).attr('action'),
        submitBtn = $('#form-submit-btn');

    submitBtn.text("Please Wait...").prop('disabled', true);

    removeValidation();
    if (url) {
        $.ajax({
            url: url,
            method: 'POST',
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function (data) {
                swalSuccess(data);
                form[0].reset();
                submitBtn.text("Save").prop('disabled', false);
            },
            error: function (request) {
                if (request.status === 422) {
                    console.log(request.responseJSON.errors)
                    displayValidation(request.responseJSON.errors);
                } else {
                    swalError()
                }
                submitBtn.text("Save").prop('disabled', false);
            }
        });
    }
});

//---------------------------- update role form---------------------

$(document).on('submit', '#update-role-form', function () {
    event.preventDefault();
    var form = $(this),
        url = $(this).attr('action'),
        name = $('input[name="display_name"]').val(),
        submitBtn = $('#form-submit-btn');

    submitBtn.text("Please Wait...").prop('disabled', true);
    removeValidation();
    if (url) {
        $.ajax({
            url: url,
            method: 'POST',
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function (data) {
                $('#page-title').html(name);
                swalSuccess(data);
                submitBtn.text("Save Changes").prop('disabled', false);
            },
            error: function (request) {
                if (request.status === 422) {
                    console.log(request.responseJSON.errors)
                    displayValidation(request.responseJSON.errors);
                } else {
                    swalError()
                }
                submitBtn.text("Save Changes").prop('disabled', false);
            }
        });
    }
});

//---------------------------- create user form---------------------

$(document).on('submit', '#create-user-form', function () {
    event.preventDefault();
    var form = $(this),
        url = $(this).attr('action'),
        submitBtn = $('#form-submit-btn');

    submitBtn.text("Please Wait...").prop('disabled', true);
    removeValidation();
    if (url) {
        $.ajax({
            url: url,
            method: 'POST',
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function (data) {
                swalSuccess(data);
                form[0].reset();
                $(".selectpicker").selectpicker("refresh");
                submitBtn.text("Save").prop('disabled', false);
            },
            error: function (request) {
                if (request.status === 422) {
                    console.log(request.responseJSON.errors)
                    displayValidation(request.responseJSON.errors);
                } else {
                    swalError()
                }
                submitBtn.text("Save").prop('disabled', false);
            }
        });
    }
});

//---------------------------- create user form---------------------

$(document).on('submit', '#update-user-form', function () {
    event.preventDefault();
    var form = $(this),
        url = $(this).attr('action'),
        name = $('input[name="name"]').val(),
        submitBtn = $('#form-submit-btn');

    submitBtn.text("Please Wait...").prop('disabled', true);

    removeValidation();
    if (url) {
        $.ajax({
            url: url,
            method: 'POST',
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function (data) {
                swalSuccess(data);
                $('input[type="password"]').val('');
                $('#page-title').html(name);
                submitBtn.text("Save Changes").prop('disabled', false);
            },
            error: function (request) {
                if (request.status === 422) {
                    console.log(request.responseJSON.errors)
                    displayValidation(request.responseJSON.errors);
                } else {
                    swalError()
                }
                submitBtn.text("Save Changes").prop('disabled', false);
            }
        });
    }
});
