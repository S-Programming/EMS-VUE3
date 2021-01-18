jQuery(function () {
    var currentIntervalRef = setInterval(function () {
        if (jQuery('#current-timer').length > 0) {
            document.getElementById("current-timer").innerHTML = new Date();
        } else {
            clearInterval(currentIntervalRef);
        }
    });
    if (typeof isUserCheckin != 'undefined' && isUserCheckin) {
        startCheckinTimer(userLastCheckinTime);
    }
});

function validateFieldsByFormId(e) {
    event.preventDefault();
    const formId = jQuery(e).closest('form').attr('id');
    const formURL = jQuery(e).closest('form').attr('action');
    const modalId = jQuery(e).closest('form').data('modal-id');
    const validationSpanId = jQuery(e).data('validation');
    var error = validateFields(formId);
    var errorMsg = '';
    var flag = true;
    if (error.length > 0) {
        showErrors(error);
        flag = false;
    }
    if (flag) {
        e.disabled = true;
        const buttonHtml = jQuery(`#` + validationSpanId).html();
        jQuery(`#` + validationSpanId).html(loadingImage());
        jQuery.ajax({
            type: "POST",
            url: formURL,
            data: jQuery('#' + formId).serialize(),
            dataType: "json",
            success: function (data) {
                e.disabled = false;
                // console.log(data.redirect_to);
                if (data.status == 'success') {
                    notificationAlert('success', data.message, 'Success!');
                    //  bsAlert(data.message, 'alert-success', 'alert_placeholder');
                    if(formId=="profile-form-id")
                    {
                        jQuery(`#` + validationSpanId).html(buttonHtml);
                    }


                    if (data.redirect_to != '' && typeof (data.redirect_to) != "undefined") {
                        setTimeout(function () {
                            reload_page(data.redirect_to)
                        }, 2000);
                    }
                    if (typeof data.html != 'undefined' && typeof data.html_section_id != 'undefined') {
                        jQuery('#' + data.html_section_id).html(data.html);
                    }
                    if (jQuery('body').hasClass('modal-open') && typeof modalId != 'undefined' && modalId != '') {
                        closeModalById(modalId);
                    }

                } else {
                    var errors = data.errors;
                    jQuery.each(errors, function (i, val) {
                        if (errors[i] != 'undefined' && errors[i] != null) {
                            let nowErrorMessage = errors[i];
                            if (i == 'errors') {
                                let newErrors = errors[i];
                                jQuery.each(newErrors, function (index, value) {
                                    nowErrorMessage = newErrors[index][0] ? newErrors[index][0] : '';
                                });
                            }
                            errorMsg += nowErrorMessage + '<br>';
                        }
                    });
                    notificationAlert('error', errorMsg, 'Inconceivable!');
                    //  bsAlert(data.message, 'alert-danger', 'alert_placeholder');
                    jQuery(`#` + validationSpanId).html(buttonHtml);
                }
            },
            error: function (data) {
                e.disabled = false;
                // Error...
                var errors = jQuery.parseJSON(data.responseText);
                jQuery.each(errors, function (i, val) {
                    if (errors[i] != 'undefined' && errors[i] != null) {
                        let nowErrorMessage = errors[i];
                        if (i == 'errors') {
                            let newErrors = errors[i];
                            jQuery.each(newErrors, function (index, value) {
                                nowErrorMessage = newErrors[index][0] ? newErrors[index][0] : '';
                            });
                        }
                        errorMsg += nowErrorMessage + '<br>';
                    }
                });
                notificationAlert('error', errorMsg, 'Inconceivable!');
                //  bsAlert(errorMsg, 'alert-danger', 'alert_placeholder');
                jQuery(`#` + validationSpanId).html(buttonHtml);
            }
        });
    }
}

function validateFields(formId) {
    var fields = jQuery("#" + formId + " :input").serializeArray();
    var error = [];
    var skipArray = ['action'];
    var emailArray = ['email'];
    var phoneNumberArray = ['phone_number'];
    var skipforEmpty = [];
    var fname = 'no_name';
    var passwordArray = ['password', 'confirm_password'];
    var regexy = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    var regexp_number = /^((\+92)|(0092))-{0,1}\d{3}-{0,1}\d{7}$|^\d{11}$|^\d{4}-\d{7}$/
    jQuery.each(fields, function (i, field) {
        fname = field.name;
        let elementObj = jQuery("textarea[name='" + fname + "']");
        if (elementObj) {
            if (elementObj.hasClass('tinymce-editor-cls')) {
                field.value = tinyMCE.activeEditor.getContent();
                elementObj.val(field.value);
            }
        }
        if (jQuery.inArray(fname, skipArray) == -1) {
            if (jQuery.trim(field.value) == '') {
                if (jQuery.inArray(fname, skipforEmpty) == -1) {
                    var myregexp = /\[(.*?)\]/;
                    var match = myregexp.exec(fname);
                    if (match != null) {
                        fname = match[1];
                    }
                    error[i] = 'Please enter ' + fname;
                }
            } else if (jQuery.inArray(fname, emailArray) > -1) {
                if (!regexy.test(field.value)) {
                    error[i] = 'Please enter correct format of email (example@example.com)';
                }
            } else if (jQuery.inArray(fname, phoneNumberArray) > -1) {
                if (!regexp_number.test(field.value)) {
                    error[i] = 'Please enter correct format of Phone number (+923123456789)';
                }
            } else if (jQuery.inArray(fname, passwordArray) > -1) {
                if ((field.value.length < 8)) {
                    error[i] = 'Please enter at least 8 Characters for the password';
                }
            }
        }

    });
    return error;
}

function showErrors(errors) {
    var msg = '';
    var error = '';
    jQuery.each(errors, function (i, val) {
        if (errors[i] != '' && typeof (errors[i]) != "undefined") {
            error = errors[i] + '<br>';
            msg += error.replace(/_/g, ' ').toLowerCase().replace(/\b[a-z]/g, function (letter) {
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
    if (type == '' || typeof (type) == "undefined") {
        type = 'error';
    }
    if (content == '' || typeof (content) == "undefined") {
        content = 'You Got Error';
    }
    if (title == '' || typeof (title) == "undefined") {
        title = '';
    }
    if (timeOut == '' || typeof (timeOut) == "undefined") {
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
            toastr.success(content, title, {timeOut: timeOut});
            break;
        case 'error':
            toastr.error(content, title, {timeOut: timeOut});
            break;
        case 'info':
            toastr.info(content, title, {timeOut: timeOut});
            break;
        case 'warning':
            toastr.warning(content, title, {timeOut: timeOut});
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

/**
 * Created by Abbas Naumani on 2/5/2018.
 */
function commonAjaxModel(route, id, containerId) {
    // console.log('abc');
    alert('fhjkh');
    if (typeof (containerId) == "undefined" || containerId == '') {
        containerId = 'common_popup_modal';
    }
    if (typeof (id) == "undefined" || id == '') {
        id = 0;
    }
    if (typeof (route) == "undefined" || route == '') {
        route = '';
    }
    if (route != '') {
        var url = baseURL + '/' + route;
        var dataToPost = {"containerId": containerId, "id": id};
        jQuery.ajax({
            type: "POST",
            url: url,
            data: dataToPost,
            dataType: "json",
            success: function (data) {
                /*If Modal Div not defined*/
                if (jQuery('#' + containerId + '_mp').length == 0) {
                    jQuery("body").append('<div id="' + containerId + '_mp"></div>');
                }
                /*Put Modal HTML in Modal Placeholder*/
                jQuery('#' + containerId + '_mp').html(data.html);
                /*Show Modal*/
                jQuery('#' + containerId).modal('show');
            }, error: function (data) {
                console.log('error');
            }
        });
    } else {
        notificationAlert('error', 'Route is not defined', 'Inconceivable!');
    }
    //  tinymce.remove('.tinymce-editor-cls');
}

/*
 * TO CLOSE SPECIFIC MODAL
 */
function closeModalById(id) {
    //jQuery('#' + id + '_close').click();
    jQuery('#' + id).modal('hide');
    setTimeout(function () {
        jQuery('#' + id + '_mp').html('');
    }, 1000);
    uploadedFilesData = [];

}

function ajaxCallOnclick(route, extraData) {
    console.log(extraData);
    if (route != '') {
        const url = baseURL + '/' + route;
        let dataToPost = typeof extraData != 'undefined' ? extraData : {};
        //console.log(dataToPost.user_id);
        jQuery.ajax({
            type: "POST",
            url: url,
            data: dataToPost,
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    notificationAlert('success', data.message, 'Success!');
                    if (typeof data.html != 'undefined' && typeof data.html_section_id != 'undefined' && data.html != '') {
                        jQuery('#' + data.html_section_id).html(data.html);
                    }
                    if (typeof dataToPost.method_to_execute != 'undefined' && dataToPost.method_to_execute != '') {
                        window[extraData.method_to_execute]();
                    }
                } else {
                    notificationAlert('error', data.message, 'Inconceivable!');
                }
                const containerId = typeof extraData.containerId != "undefined" ? extraData.containerId : false;
                if (jQuery('body').hasClass('modal-open') && containerId) {
                    closeModalById(containerId);
                }
            }, error: function (data) {
                console.log('error');
            }
        });

    } else {
        notificationAlert('error', 'Route is not defined', 'Inconceivable!');
    }
}

function deleteRecord(route, id, extraData) {
    if (route != '') {

        jQuery.ajax({
        url: route,
        type: 'POST',
        data: {id: id},
        success: function (data) {
            if (data.status == 'success') {
                notificationAlert('success', data.message, 'Success!');
                const containerId = typeof extraData.containerId != "undefined" ? extraData.containerId : false;
                if (jQuery('body').hasClass('modal-open') && containerId) {
                    closeModalById(containerId);
                }
                setTimeout(function () {
                    window.location.reload();

                    }, 0)
                } else {
                    notificationAlert('error', data.message, 'Inconceivable!');
                }
            }, error: function (data) {
                console.log('error');
            }
        });
    } else {
        notificationAlert('error', 'Route is not defined', 'Inconceivable!');
    }
}

function deleteRoleRecord(route, id, extraData) {
    if (route != '') {
        jQuery.ajax({

            url: route,
            type: 'POST',
            data: {id: id},
            success: function (data) {

                if (data.status == 'success') {
                    notificationAlert('success', data.message, 'Success!');
                    const containerId = typeof extraData.containerId != "undefined" ? extraData.containerId : false;
                    if (jQuery('body').hasClass('modal-open') && containerId) {
                        closeModalById(containerId);
                    }
                    setTimeout(function () {
                        window.location.reload();

                    }, 0)
                } else {
                    notificationAlert('error', 'Route is not defined', 'Inconceivable!');
                }

            }
        });
    } else {
        notificationAlert('error', 'Route is not defined', 'Inconceivable!');
    }
}


var startCheckinTimer = function (startTime) {
    const startDateTime = (typeof startTime != "undefined" && startTime != '' && startTime != null) ? startTime : null;
    var countDownDate = startDateTime ? new Date(startDateTime).getTime() : new Date().getTime(); //"Jan 8, 2021 6:37:25"
// Update the count down every 1 second
    const intervalRef = setInterval(function () {

        // Get today's date and time
        var now = new Date().getTime();

        // Find the distance between now and the count down date
        var distance = now - countDownDate;

        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        // Output the result in an element with id="demo"
        let DaysTimer = ((days > 1) ? days + ' Days, ' : ((days > 0) ? days + 'Day, ' : ''));
        if (jQuery('#checkin-timer').length > 0) {
            document.getElementById("checkin-timer").innerHTML = DaysTimer + hours + "h "
                + minutes + "m " + seconds + "s ";
            // If the count down is over, write some text
            if (distance < 0) {
                clearInterval(intervalRef);
                document.getElementById("checkin-timer").innerHTML = "EXPIRED";
            }
        } else {
            clearInterval(intervalRef);
        }
    }, 1000);
}

