let arrows;

if (KTUtil.isRTL()) {
    arrows = {
        leftArrow: '<i class="la la-angle-right"></i>',
        rightArrow: '<i class="la la-angle-left"></i>'
    }
} else {
    arrows = {
        leftArrow: '<i class="la la-angle-left"></i>',
        rightArrow: '<i class="la la-angle-right"></i>'
    }
}


let removeValidationMessages = function () {
    /** Remove All Validation Messages **/

    let errorElements = $('.invalid-feedback');

    errorElements.html('').css('display', 'none');

    $('form .form-control').removeClass('is-invalid is-valid') // remove validation borders

}

let displayValidationMessages = function (errors, trailing = "", value = '') {

    removeValidationMessages();

    if (value !== '') {
        $('#submitted-form .form-control' + value).addClass('is-valid')
    } else
        $('#submitted-form .form-control').addClass('is-valid') // remove validation borders

    /** Display All Validation Messages **/
    $.each(errors, function (elementId, errorMessage) {

        elementId = elementId.replaceAll('.', '_');

        let errorInput = $("#" + elementId + '_inp' + trailing);
        let errorElement = $("#" + elementId + trailing);

        if (errorElement != null)
            errorElement.html(errorMessage).css('display', 'block')
        if (errorInput != null)
            errorInput.addClass('is-invalid')

    });

    /** scroll to the first error element **/
    let firstErrorElementId = Object.keys(errors)[0].replaceAll('.', '_');

    let firstErrorElement = document.getElementById(firstErrorElementId + trailing);

    firstErrorElement.scrollIntoView({ behavior: 'smooth', block: 'center' });


}

/** click on ... to show the text in DataTables **/

let showMoreInDT = function (element) {
    console.log(12)
    $(element).next().hide();
    $(element).next().next().show();

}

let getStatusObject = function (statusNameEn) {

    return ordersStatuses.find((status) => status['name_en'] === statusNameEn) ?? {
        "name_ar": statusNameEn,
        "name_en": statusNameEn,
        "color": "#219ed4"
    };
}

let showHidePass = function (fieldId, showPwIcon) {
    let passField = $("#" + fieldId);

    if (passField.attr("type") === "password") {
        passField.attr("type", "text");
        showPwIcon.children().eq(0).removeClass("fa-eye").addClass("fa-eye-slash");
    } else {
        passField.attr("type", "password");
        showPwIcon.children().eq(0).removeClass("fa-eye-slash").addClass("fa-eye");
    }

}

let blockUi = function (id) {
    /** block container ui **/
    KTApp.block(id, {
        overlayColor: '#000000',
        state: 'danger',
        message: translate('Please wait ...'),
    });
}

let unBlockUi = function (id, timer = 0) {
    /** unblock container ui **/
    setTimeout(function () {
        KTApp.unblock(id);
    }, timer);
}

/** Begin :: System Alerts  **/

let deleteAlert = function (elementName = translate("item"),) {
    return Swal.fire({
        text: `${translate('Are you sure you want to delete this') + ' ' + elementName + ' ' + translate('?') + ' ' + translate('All data related to this') + ' ' + elementName + ' ' + translate('will be deleted')}`,
        icon: "warning",
        showCancelButton: true,
        buttonsStyling: false,
        confirmButtonText: translate('Yes, Delete !'),
        cancelButtonText: translate('No, Cancel'),
        customClass: {
            confirmButton: "btn fw-bold btn-danger",
            cancelButton: "btn fw-bold btn-active-light-primary"
        }
    })
}


let archiveAlert = function () {
    return Swal.fire({
        text: translate('There is no finished analysis to archive'),
        icon: "warning",
        showCancelButton: true,
        buttonsStyling: true,
        cancelButtonText: translate('cancel'),
        customClass: {
            cancelButton: "btn fw-bold btn-active-light-primary"
        }
    })
}

let errorAlert = function (message = translate("something went wrong"), time = 5000) {
    return Swal.fire({
        text: translate(message),
        icon: "error",
        buttonsStyling: false,
        showConfirmButton: false,
        timer: time,
        customClass: {
            confirmButton: "btn fw-bold btn-primary",
        }
    });
}

let successAlert = function (message = translate("Operation done successfully"), timer = 2000) {

    return Swal.fire({
        text: message,
        icon: "success",
        buttonsStyling: false,
        showConfirmButton: false,
        timer: timer
    });

}

let inputAlert = function () {

    return Swal.fire({
        icon: 'warning',
        title: translate('write a comment'),
        html: '<input id="swal-input1" class="form-control">',
        showCancelButton: true,
        focusConfirm: false,
        confirmButtonColor: '#1E1E2D',
        cancelButtonColor: '#c61919',
        confirmButtonText: `<span> ${translate('change')} </span>`,
        cancelButtonText: `<span> ${translate('cancel')} </span>`,
        preConfirm: () => {
            return [
                document.getElementById('swal-input1').value,
            ]
        },
    });

}

let changeStatusAlert = function (type = "change") {

    if (type == 'date') {
        return Swal.fire({
            icon: 'warning',
            title: translate('Pick new date'),
            html: '<input type="date" required id="swal-input1" class="form-control">',
            showCancelButton: true,
            focusConfirm: false,
            confirmButtonColor: '#1E1E2D',
            cancelButtonColor: '#c61919',
            confirmButtonText: `<span> ${translate('change')} </span>`,
            cancelButtonText: `<span> ${translate('cancel')} </span>`,
            preConfirm: () => {
                return [
                    document.getElementById('swal-input1').value,
                ]
            },
        });
    }

    return Swal.fire({
        icon: 'warning',
        title: translate('change order status'),
        showCancelButton: true,
        focusConfirm: false,
        confirmButtonColor: '#1E1E2D',
        cancelButtonColor: '#c61919',
        confirmButtonText: `<span> ${translate('change')} </span>`,
        cancelButtonText: `<span> ${translate('cancel')} </span>`,

    });

}


let warningAlert = function (title, message, time = 5000) {
    return swal.fire({
        title: translate(title),
        text: translate(message),
        icon: "warning",
        showConfirmButton: false,
        timer: time
    });
}

let unauthorizedAlert = function () {
    return swal.fire({
        title: translate("Error !"),
        text: translate("This action is unauthorized."),
        icon: "error",
        showConfirmButton: false,
        timer: 5000,
    });
}

let loadingAlert = function (message = translate("Loading...")) {

    return Swal.fire({
        text: message,
        icon: "info",
        buttonsStyling: false,
        showConfirmButton: false,
        timer: 2000
    });

}

let getImagePath = function (directory, imageName) {

    return imagesBasePath + '/' + directory + '/' + imageName;
}

/** End :: System Alerts  **/

let initTinyMc = function (editingInp = false) {

    tinymce.init({
        selector: ".tinymce",
        menubar: false,
        toolbar: ["styleselect save",
            "undo redo | cut copy paste | bold italic | link image | alignleft aligncenter alignright alignjustify forecolor backcolor",
            "bullist numlist | outdent indent | blockquote subscript superscript | advlist | autolink | lists charmap | print preview |  code"],
        plugins: "advlist autolink link lists charmap print preview code save",
        save_onsavecallback: function () {
        }
    });

    if (!editingInp)
        $('.tinymce').val(null);

}


/** Start :: Submit any form in dashboard function  **/
let submitForm = (form) => {

    let formData = new FormData(form);
    form = $(form);
    let submitBtn = form.find("[id*=submit-btn]");

    //submitBtn.attr('disabled', true).attr("data-kt-indicator", "on");
    $('#submit-btn').attr('disabled', true)

    $.ajax({
        method: form.attr('method'),
        url: form.attr('action'),
        data: formData,
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        processData: false,
        contentType: false,
        cache: false,
        enctype: 'multipart/form-data',
        success: function () {
            removeValidationMessages();
            successAlert(form.data('success-message')).then(() => window.location.replace(form.data('redirection-url')));
        },
        error: function (response) {

            removeValidationMessages();

            if (response.status === 422)
                displayValidationMessages(response.responseJSON.errors, form.data('trailing'), form.data('with-key'));
            else if (response.status === 403)
                unauthorizedAlert();
            else
                errorAlert(response.responseJSON.message, 5000)
        },
        complete: function () {
            //submitBtn.attr('disabled', false).removeAttr("data-kt-indicator")
            $('#submit-btn').attr('disabled', false)

        }
    });

}
/** End   :: Submit any form in dashboard function  **/

/** Start :: save tinymce editor function  **/
let saveTinyMceEditors = () => {
    return new Promise(async (resolve, reject) => {

        await $('textarea[class="tinymce"]').each((index, element) => tinymce.get($(element).attr('id')).execCommand('mceSave'))

        resolve()
    });
}
/** End   :: save tinymce editor function  **/


$(document).ready(function () {

    /** Start :: ajax request form  **/
    $('#submitted-form,.submitted-form,#role_form_update,#role_form_add').submit(function (event) {

        event.preventDefault();


        // save tinymce editors then submit the form in resolve
        saveTinyMceEditors().then(() => submitForm(this));

    })
    /** End   :: ajax request form  **/

    /** initialize datepicker inputs */
    $(".datepicker").daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        minYear: 2000,
        locale: {
            format: 'YYYY-MM-DD',
            cancelLabel: translate('Clear'),
            applyLabel: translate('Apply'),
        },
        maxYear: parseInt(moment().format("YYYY"), 10)
    }).val('').on('cancel.daterangepicker', function (ev, picker) {
        $(this).val('').trigger('change');
    });

    /** initialize datepicker inputs */
    $(".datepicker-time").daterangepicker({
        timePicker: true,
        singleDatePicker: true,
        showDropdowns: true,
        minYear: 2000,
        locale: {
            format: 'YYYY-MM-DD hh:mm:ss',
            cancelLabel: translate('Clear'),
            applyLabel: translate('Apply'),
        },
        maxYear: parseInt(moment().format("YYYY"), 10)
    }).val('').on('cancel.daterangepicker', function (ev, picker) {
        $(this).val('').trigger('change');
    });

    /** customizing select2 message */

    if ($('select').length) {
        $('select').select2({
            "language": {
                "noResults": function () {
                    return translate("No results found");
                }
            },
            allowClear: false
        })
    }


})


function addValidationToArrayFormRepeater(selector) {
    setTimeout(() => {
        $(selector).each(function (index) {
            let idData = $(this).attr('id');
            $(this).attr('id', idData.replace(/\d+/, index));

        });
    }, 1500);
}
