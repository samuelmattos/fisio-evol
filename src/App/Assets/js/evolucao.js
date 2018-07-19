let nova_evolucao = document.querySelector('#nova_evolucao');

nova_evolucao.onclick = function () {
    var id = $("#id_paciente").val();
    $("#nova_evolucao").addClass("loading");
    axios.get('cadastrar/'+id).then((response) => {
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
        console.log(error);
        $("#cad_evolucao").removeClass("loading");
    });
};