function validateFieldsByFormId(e) {
    event.preventDefault();
    const formId = jQuery(e).closest('form').attr('id');
    const formURL = jQuery(e).closest('form').attr('action');
    const modalId = jQuery(e).closest('form').data('modal-id');
    const validationSpanId = jQuery(e).data('validation');
    var description =  tinyMCE.activeEditor.getContent();
    //tinyMCE.activeEditor.getContent({format : 'raw'});
      //  tinymce.get('tinymce-editor-cls').getContent();
    console.log(description);
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
                if (data.status == 'success') {
                    notificationAlert('success', data.message, 'Success!');
                    //  bsAlert(data.message, 'alert-success', 'alert_placeholder');
                    if (data.redirect_to != '' && typeof (data.redirect_to) != "undefined") {
                        setTimeout(function () {
                            reload_page(data.redirect_to)
                        }, 2000);
                    }
                    if(typeof data.html !='undefined' && typeof data.html_section_id!='undefined'){
                        jQuery('#'+data.html_section_id).html(data.html);
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
    var skipforEmpty = [];
    var fname = 'no_name';
    var regexy = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    jQuery.each(fields, function (i, field) {
        fname = field.name;
            let elementObj=jQuery("textarea[name='"+fname+"']");
            if(elementObj){
            if(elementObj.hasClass('tinymce-editor-cls')){
            field.value =  tinyMCE.activeEditor.getContent();
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
    tinymce.remove('.tinymce-editor-cls');
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
    if (route != '') {
        const url = baseURL + '/' + route;
        let dataToPost = typeof extraData != 'undefined' ? extraData : {};
        jQuery.ajax({
            type: "POST",
            url: url,
            data: dataToPost,
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    notificationAlert('success', data.message, 'Success!');
                    if (typeof data.html != 'undefined'&&typeof data.html_section_id != 'undefined' && data.html != '') {
                        jQuery('#'+data.html_section_id).html(data.html);
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

