function remember() {
    var formData = getFormData($("#remember_form"));
    $("#remember_form").addClass("loading");
    axios.post('send_email', formData).then((response) => {
        $("#remember_form").removeClass("loading");
        console.log(response.data);
        popError('Atenção', response.data);
    }).catch(error => {
        $("#remember_form").removeClass("loading");
        popError('Erro', error.response.data.error.message);
    });
};