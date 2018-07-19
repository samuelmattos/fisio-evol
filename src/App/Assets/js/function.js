function getFormData($form) {
    var unindexed_array = $form.serializeArray();
    var formdata = new FormData();
    $.map(unindexed_array, function (n, i) {
        formdata.append(n['name'], n['value']);
    });
    return formdata;
}