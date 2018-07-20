let nova_evolucao = document.querySelector('#nova_evolucao');

nova_evolucao.onclick = function () {
    var id = $("#id_paciente").val();
    $("#nova_evolucao").addClass("loading");
    axios.get('cadastrar/' + id).then((response) => {
        $('#control').text('');
        $('#control').append(response.data);
        $("#nova_evolucao").removeClass("loading");
    });
};

function cadastrarEvolucao() {
    var formData = getFormData($("#cad_evolucao"));
    $("#cad_evolucao").addClass("loading");
    axios.post('salvar', formData).then((response) => {
        $('#control').text('');
        $('#control').append(response.data);
        $("#cad_evolucao").removeClass("loading");
    }).catch(error => {
        $("#cad_evolucao").removeClass("loading");
        popError('Erro', error.response.data.error.message);
    });
};
function confirmaRemocao(id, id_paciente) {
    popRemove('Atenção', 'Deseja remover a evolução do sistema?', function(){
        return removeEvolucao(id, id_paciente);
    });
}
function removeEvolucao(id, id_paciente) {
    $("#cad_evolucao").addClass("loading");
    axios.get('remove/' + id + '/' + id_paciente).then((response) => {
        $('#control').text('');
        $('#control').append(response.data);
        $("#cad_evolucao").removeClass("loading");
    });
}