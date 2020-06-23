const evolucoes_vue = new Vue({
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
        popCadastro(response.data);
        $("#nova_evolucao").removeClass("loading");
    }).catch(error => {
        $("#nova_evolucao").removeClass("loading");
        popError('Erro', error);
    });
};

cadastrarEvolucao = function () {
    var formData = getFormData($("#cad_evolucao"));
    $("#cad_evolucao").addClass("loading");
    axios.post('salvar', formData).then((response) => {
        $("#cad_evolucao").removeClass("loading");
        $('#myModal').modal('toggle');
        var avaliacao = response.data.evolucao;
        evolucoes_vue.evolucoes.push(avaliacao);
    }).catch(error => {
        $("#cad_evolucao").removeClass("loading");
        $('#myModal').modal('toggle');
        popError('Erro', error.response.data.error.message);
    });
};

editarEvolucao = function (id_evolucao, index) {
    var formData = getFormData($("#cad_evolucao"));
    $("#cad_evolucao").addClass("loading");
    axios.post('update/' + id_evolucao, formData).then((response) => {
        if (response.data == 1) {
            evol = [];
            getFormData($("#cad_evolucao")).forEach(function (value, key) {
                evol[key] = value;
            });
            evolucoes_vue.evolucoes.splice(index, 1, evol)
            $('#myModal').modal('toggle');
        }
        $("#cad_evolucao").removeClass("loading");
    }).catch(error => {
        $("#cad_evolucao").removeClass("loading");
        popError('Erro', error.response.data.error.message);
    });
};

confirmaRemocao = function (id, id_paciente) {
    creat_popup('Atenção', 'Deseja remover a evolução do sistema?', function () {
        return removeEvolucao(id, id_paciente);
    });
};

removeEvolucao = function (id, id_paciente, index) {
    axios.get('remove/' + id + '/' + id_paciente).then((response) => {
        if (response.data) {
            evolucoes_vue.evolucoes.splice(index, 1);
        }
    }).catch(error => {
        popError('Erro', error.response.data.error.message);
    });
};

viewEditEvolucao = function (id_evolucao, index) {
    $("#cad_evolucao").addClass("loading");
    axios.get('viewEdit/' + id_evolucao + '/' + index).then((response) => {
        popCadastro(response.data);
        $("#cad_evolucao").removeClass("loading");
    });
};

loadEvolution = function(evolution_back) {
    // evolucoes_vue.evolucoes.push(avaliacao);
    evolution_back.forEach(function(item){
        evolucoes_vue.evolucoes.push(item);
    });
}