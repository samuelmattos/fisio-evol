let nova_evolucao = document.querySelector('#nova_evolucao');

nova_evolucao.onclick = function () {
    $("#nova_evolucao").addClass("loading");
    axios.get('cadastrar').then((response) => {
        $('#control').text('');
        $('#control').append(response.data);
        $("#nova_evolucao").removeClass("loading");
    });
};