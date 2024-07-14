// start code for checking all checkboxes
$("#edit-select-all, #add-select-all").change(function () {
    let updatedForm = "#package_form_" + $(this).data("form-type");
    if ($(this).prop("checked")) {
        $(`${updatedForm} input[type="checkbox"]`)
            .prop("checked", true)
            .each((index, value) => $(value).val($(value).data("id")));
    } else {
        $(`${updatedForm} input[type="checkbox"]`)
            .prop("checked", false)
            .each((index, value) => $(value).val(null));
    }
}); // end code for checking all checkboxes

// start code for getting the package data by ajax request
$(".edit-package-btn").click(function () {
    let clickedBtn = $(this);
    let packageId = $(this).data("package-id");
    clickedBtn.attr("disabled", true).attr("data-kt-indicator", "on");
    removeValidationMessages();
    /** turn of all checkboxes of the previous edited package **/

    $(".edit-checkbox").prop("checked", false);
    $.ajax({
        url: "/super_admin_dashboard/packages/" + packageId,
        method: "GET",

        success: function (response) {
            $("#kt_modal_update_package").modal("show");
            clickedBtn.attr("disabled", false).removeAttr("data-kt-indicator");

            // set the package name
            $("#name_inp_edit").val(response["name"]);

            // set the package annual price
            $("#annual_price_inp_edit").val(response["annual_price"]);

            // set the package monthly price
            $("#monthly_price_inp_edit").val(response["monthly_price"]);

            // set the package discount percentage
            $("#discount_percentage_inp_edit").val(
                response["discount_percentage"]
            );


            // set the route to the update form
            $("#package_form_update").attr(
                "action",
                `/super_admin_dashboard/packages/${packageId}`
            );
        },
    });
});
// start code for getting the package data by ajax request

// start code for customizing the checkbox value to its ability id
$(":checkbox").change(function () {
    if ($(this).prop("checked")) $(this).val($(this).data("id"));
    else $(this).val(null);
});
// end   code for customizing the checkbox value to its ability id

$("#data_kt_edit_feature_options").repeater({
    initEmpty: !1,
    defaultValues: {"text-input": "foo"},
    show: function () {
        $(this).slideDown(),
            document.querySelectorAll('[data_kt_edit_feature="feature_option"]').forEach((e => {
                $(e).hasClass("select2-hidden-accessible") || $(e).select2({minimumResultsForSearch: -1})
            }))

    },
    hide: function (e) {
        $(this).slideUp(e)
    },
    ready: function () {
        // Init select2
        $('[data-kt-repeater="select2"]').select2();
    },
});

        $("#data_kt_add_feature_options").repeater({
            initEmpty: !1,
            defaultValues: {"text-input": "foo"},
            show: function () {
                $(this).slideDown(),
                document.querySelectorAll('[data_kt_add_feature="feature_option"]').forEach((e => {
                    $(e).hasClass("select2-hidden-accessible") || $(e).select2({minimumResultsForSearch: -1})
                }))

            },
            hide: function (e) {
                $(this).slideUp(e)
            },
            ready: function () {
                // Init select2
                $('[data-kt-repeater="select2"]').select2();
            },
        });
    function loadFeatures(element) {

        element.select2({
            minimumInputLength: 3,
            delay: 1000,
            placeholder: "Select a feature...",
            ajax: {
                cacheDataSource: [],
                url: getFeatursUrl,
                method: 'get',
                dataType: 'json',
                delay: 1000,
                processResults: function (data) {
                    // Transforms the top-level key of the response object from 'items' to 'results'
                    return {
                        results: $.map(data, function (item, index) {
                            return {
                                id: item.id,
                                text: item.name,
                            }
                        }),
                    };
                },
            }
        });

    }
