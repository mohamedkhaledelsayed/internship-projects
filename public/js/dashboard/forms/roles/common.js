// start code for checking all checkboxes

$("#edit-select-all, #add-select-all").change(function () {
    let updatedForm = '#role_form_' + $(this).data('form-type');
    console.log(updatedForm)
    if($(this).prop('checked')) {
        $(`${updatedForm} input[type="checkbox"]`).prop('checked',true).each( (index, value) => $(value).val( $(value).data('id') ));
    } else {
        $(`${updatedForm} input[type="checkbox"]`).prop('checked',false).each( (index, value) => $(value).val( null ));
    }
});// end code for checking all checkboxes


// start code for getting the role data by ajax request
$('.edit-role-btn').click( function () {
    let clickedBtn = $(this);
    let roleId     = $(this).data('role-id');
    clickedBtn.attr('disabled',true).attr("data-kt-indicator", "on")
    // removeValidationMessages();
    /** turn of all checkboxes of the previous edited role **/

    $('.edit-checkbox').prop('checked',false);
    $.ajax({
        url:route +'/'+ roleId,
        method:"GET",
        success:function (response) {

            $("#kt_modal_update_role").modal('show');
            clickedBtn.attr('disabled',false).removeAttr("data-kt-indicator")
            // set the role name
            $("#name_inp_edit").val( response['name'] );

            // set the route to the update form
            $("#role_form_update").attr('action',`${route}/${roleId}`);

            // set the abilities of the role to checkboxes
            response['role_permissions'].forEach(function (element) {

                let checkBox = $(`#edit_${element['name']}`);
                checkBox.prop('checked',true);
                checkBox.val( element['id'] );

            });

        },
    });

});
// start code for getting the role data by ajax request




// start code for customizing the checkbox value to its ability id
$(':checkbox').change(function () {
    if ( $(this).prop('checked'))
        $(this).val( $(this).data('id'));
    else
        $(this).val(null);
});
// end   code for customizing the checkbox value to its ability id
