function validateFieldsByFormId(e) {
    event.preventDefault();
    const formId = $(e).closest('form').attr('id');
    const formURL = $(e).closest('form').attr('action');
    const validationSpanId = $(e).data('validation');
    var error = validateFields(formId);
    var errorMsg = '';
    var flag = true;
    if (error.length > 0) {
        showErrors(error);
        flag = false;
    }
    if (flag) {
        e.disabled = true;
        const buttonHtml = $(`#${validationSpanId}`).html();
        $(`#${validationSpanId}`).html(loadingImage());
        $.ajax({
            type: "POST",
            url: formURL,
            data: $('#' + formId).serialize(),
            dataType: "json",
            success: function(data) {
                e.disabled = false;
                if (data.status == 'success') {
                    notificationAlert('success', data.message, 'Success!');
                    //  bsAlert(data.message, 'alert-success', 'alert_placeholder');
                    if (data.redirect_to != '' && typeof(data.redirect_to) != "undefined") {
                        setTimeout(function() {
                            reload_page(data.redirect_to)
                        }, 2000);
                    } else {
                        console.log('not redirecting');
                    }
                } else {
                    var errors = data.errors;
                    $.each(errors, function(i, val) {
                        if (errors[i] != 'undefined' && errors[i] != null) {
                            let nowErrorMessage = errors[i];
                            if (i == 'errors') {
                                let newErrors = errors[i];
                                $.each(newErrors, function(index, value) {
                                    nowErrorMessage = newErrors[index][0] ? newErrors[index][0] : '';
                                });
                            }
                            errorMsg += nowErrorMessage + '<br>';
                        }
                    });
                    notificationAlert('error', errorMsg, 'Inconceivable!');
                    //  bsAlert(data.message, 'alert-danger', 'alert_placeholder');
                    $(`#${validationSpanId}`).html(buttonHtml);
                }

            },
            error: function(data) {
                e.disabled = false;
                // Error...
                var errors = $.parseJSON(data.responseText);
                $.each(errors, function(i, val) {
                    if (errors[i] != 'undefined' && errors[i] != null) {
                        let nowErrorMessage = errors[i];
                        if (i == 'errors') {
                            let newErrors = errors[i];
                            $.each(newErrors, function(index, value) {
                                nowErrorMessage = newErrors[index][0] ? newErrors[index][0] : '';
                            });
                        }
                        errorMsg += nowErrorMessage + '<br>';
                    }
                });
                notificationAlert('error', errorMsg, 'Inconceivable!');
                //  bsAlert(errorMsg, 'alert-danger', 'alert_placeholder');
                $(`#${validationSpanId}`).html(buttonHtml);
            }
        });
    }
}
function validateFields(formId) {
    var fields = $("#" + formId + " :input").serializeArray();
    var error = [];
    var skipArray = ['action'];
    var emailArray = ['email'];
    var skipforEmpty = [];
    var fname = 'no_name';
    var regexy = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    $.each(fields, function(i, field) {
        fname = field.name;
        if ($.inArray(fname, skipArray) == -1) {
            if ($.trim(field.value) == '') {
                if ($.inArray(fname, skipforEmpty) == -1) {
                    var myregexp = /\[(.*?)\]/;
                    var match = myregexp.exec(fname);
                    if (match != null) {
                        fname = match[1];
                    }
                    error[i] = 'Please enter ' + fname;
                }
            } else if ($.inArray(fname, emailArray) > -1) {
                if (!regexy.test(field.value)) {
                    error[i] = 'Please enter correct format of email (example@example.com)';
                }
            }
        }
    });
    return error;
}
function showErrors(errors) {
    var msg = '';
    var error = '';
    $.each(errors, function(i, val) {
        if (errors[i] != '' && typeof(errors[i]) != "undefined") {
            error = errors[i] + '<br>';
            msg += error.replace(/_/g, ' ').toLowerCase().replace(/\b[a-z]/g, function(letter) {
                return letter.toUpperCase();
            });
        }
    });
    if (msg != '') {
        notificationAlert('error', msg);
        //bsAlert(msg, 'alert-danger', 'alert_placeholder');
    }
}

/*
 * ## Type can be either error, success, warning Or info
 * ## Content will show the Message to display
 * ## Title is the heading of Message if any
 * ## TimeOut in seconds
 * */
function notificationAlert(type, content, title, timeOut) {
    if (type == '' || typeof(type) == "undefined") {
        type = 'error';
    }
    if (content == '' || typeof(content) == "undefined") {
        content = 'You Got Error';
    }
    if (title == '' || typeof(title) == "undefined") {
        title = '';
    }
    if (timeOut == '' || typeof(timeOut) == "undefined") {
        timeOut = 5; // in seconds
    }
    timeOut = timeOut * 1000;

    /*// by Default Toastr accept time in Micro Seconds so multiplying by 1000*/

    content = content.replace(/_/g, ' ');
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": timeOut,
        "extendedTimeOut": timeOut,
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
    switch (type) {
        case 'success':
            toastr.success(content, title, { timeOut: timeOut });
            break;
        case 'error':
            toastr.error(content, title, { timeOut: timeOut });
            break;
        case 'info':
            toastr.info(content, title, { timeOut: timeOut });
            break;
        case 'warning':
            toastr.warning(content, title, { timeOut: timeOut });
            break;
    }
}
function loadingImage() {
    var html = '<img src="' + baseURL + '/assets/images/loading.gif" >';
    return html;
}
function reload_page(url) {
    location.href = baseURL + url;
}
