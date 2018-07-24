var evolucoes_vue = new Vue({
    delimiters: ['%{', '}'],
    el: '#evolucoes_vue',
    data: {
        evolucoes: []
    }
})

let nova_evolucao = document.querySelector('#nova_evolucao');
nova_evolucao.onclick = function () {
    var id_paciente = $("#id_paciente").val();
    $("#nova_evolucao").addClass("loading");
    axios.get('cadastrar/' + id_paciente + '/' + null).then((response) => {
        $('#control').append(response.data);
        $("#nova_evolucao").removeClass("loading");
    }).catch(error => {
        w
        $("#nova_evolucao").removeClass("loading");
        popError('Erro', error);
    });
};

function cadastrarEvolucao() {
    var formData = getFormData($("#cad_evolucao"));
    $("#cad_evolucao").addClass("loading");
    axios.post('salvar', formData).then((response) => {
        $('#control').append(response.data);
        $("#cad_evolucao").removeClass("loading");
    }).catch(error => {
        $("#cad_evolucao").removeClass("loading");
        popError('Erro', error.response.data.error.message);
    });
};

function editarEvolucao(id_evolucao) {
    var formData = getFormData($("#cad_evolucao"));
    $("#cad_evolucao").addClass("loading");
    axios.post('update/' + id_evolucao, formData).then((response) => {
        $('#control').text('');
        $('#control').append(response.data);
        $("#cad_evolucao").removeClass("loading");
    }).catch(error => {
        $("#cad_evolucao").removeClass("loading");
        popError('Erro', error.response.data.error.message);
    });
};

function confirmaRemocao(id, id_paciente) {
    popRemove('Atenção', 'Deseja remover a evolução do sistema?', function () {
        return removeEvolucao(id, id_paciente);
    });
};

function removeEvolucao(id, id_paciente) {
    $("#cad_evolucao").addClass("loading");
    axios.get('remove/' + id + '/' + id_paciente).then((response) => {
        $('#control').text('');
        $('#control').append(response.data);
        $("#cad_evolucao").removeClass("loading");
    });
};

function viewEditEvolucao(id_evolucao) {
    $("#cad_evolucao").addClass("loading");
    axios.get('edit/' + id_evolucao).then((response) => {
        $('#control').text('');
        $('#control').append(response.data);
        $("#cad_evolucao").removeClass("loading");
    });
};

function viewRelatorio() {
    var id_paciente = $("#id_paciente").val();
    $("#control").addClass("ui loading");
    axios.get('relatorio/' + id_paciente).then((response) => {
        evolucoes_vue.evolucoes = response.data.evolucoes;
        $("#control").removeClass("loading");
    });
}