
export default {
  name: "evolution",
  delimiters: ['%{', '}'],
  props: { evol: Object, index: Number},
  methods: {
    viewEditEvolucao: function(id_evolucao, index) {
      viewEditEvolucao(id_evolucao, index);
    },
    confirmaRemocao: function(id_evolucao, inid_pacientedex, index) {
      confirmaRemocao(id_evolucao, id_paciente, index);
    }
  },
  template: `<div class="row">
    <div class="col-auto text-center flex-column d-none d-sm-flex">
      <div class="row h-50">
        <div class="col">&nbsp;</div>
        <div class="col">&nbsp;</div>
      </div>
      <h5 class="m-2">
        <span class="badge badge-pill bg-light border">&nbsp;</span>
      </h5>
      <div class="row h-50">
        <div class="col">&nbsp;</div>
        <div class="col">&nbsp;</div>
      </div>
    </div>
    <div class="col py-2">
      <div class="card">
        <div class="card-body">
          <div class="float-right text-muted">%{ evol.data }</div>
          <h4 class="card-title text-muted">Eva %{ evol.eva }</h4>
          <p class="card-text">%{ evol.descricao }</p>
          <a
            class="btn btn-warning btn-sm text-white"
            @click="viewEditEvolucao( evol.id_evolucao, index)"
          >Editar</a>
          <a
            class="btn btn-danger btn-sm text-white"
            @click="confirmaRemocao(evol.id_evolucao ,evol.id_paciente,
                     index)"
          >Remover</a>
        </div>
      </div>
    </div>
  </div>`
};