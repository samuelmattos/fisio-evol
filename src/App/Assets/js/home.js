function remember() {
    var formData = getFormData($("#remember_form"));
    $("#remember_form").addClass("loading");
    axios.post('send_email', formData).then((response) => {
        $("#remember_form").removeClass("loading");
        $('.ui.modal').modal('hide');
        $(".ui.modal").remove();
        var avaliacao = response.data.evolucao;
        evolucoes_vue.evolucoes.push(avaliacao);
    }).catch(error => {
        $("#remember_form").removeClass("loading");
        $('.ui.modal').modal('hide');
        $(".ui.modal").remove();
        popError('Erro', error.response.data.error.message);
    });
};