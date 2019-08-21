<?php

namespace App\Controllers\user;

use App\Core\Controller;
use App\Core\Validate;
use App\Model\Evolucao;
use App\Model\Pacientes;
use App\Model\User;
use Dompdf\Dompdf;

class evolucaoController extends Controller
{
    private $paciente;
    private $evolucao;
    private $user;
    public function __construct()
    {
        $this->user = (new User)->user();
        $this->paciente = new Pacientes;
        $this->evolucao = new Evolucao;
    }

    public function index($request, $response, $args)
    {
        //alem do paciente tenho que encaminhar as evolucao
        $paciente = $this->paciente;
        $user = $this->user;
        $evolucao = $this->evolucao;
        $paciente = $paciente->select()->where('id_paciente', $args['id'])->first();

        $evolucoes = $evolucao->get_evolucoes($paciente->id_paciente, $user->id_user);
        $dados['paciente'] = $paciente;
        $dados['title'] = 'Evolução';
        $evolucoes = json_encode($evolucoes);
        $dados['evolucoes'] = html_entity_decode($evolucoes, ENT_QUOTES, "utf-8");
        $dados['links'] = $this->evolucao->links();       
        $this->view('user.evolucao', $dados);
        $response->getBody()->write('');
        return $response;
    }

    public function create($request, $response, $args)
    {
        //alem do paciente tenho que encaminhar as evolucao
        $args['acao'] = 'Cadastrar';
        $args['id_paciente'] = $args['id_paciente'];
        $args['action'] = 'javascript:cadastrarEvolucao();';
        $this->view('user.cadastra_evolucao', $args);
        $response->getBody()->write('');
        return $response;
    }

    public function store($request, $response, $args)
    {
        $validate = new Validate;
        $data = $validate->validate([
            'descricao' => 'required',
            'data' => 'required',
        ]);

        if ($validate->hasErrors()) {
            return $this->create();
        }
        /**
         *Terminei a validação, agora estou pegando o id do usuário,
         * tenho que pegar o id do paciente esqueci de mandar por parametro no form.
         */
        $user = $this->user;
        $data->id_user = $user->id_user;
        $evolucao = $this->evolucao->create((array) $data);
        if ($evolucao) {
            $evolucao = $this->evolucao->findBy('id_evolucao', $evolucao);
            $evolucao->data = date('d/m/Y', strtotime($evolucao->data));
            $dados['evolucao'] = $evolucao;
            $payload = json_encode($dados);
            $response->getBody()->write($payload);
            return $response
              ->withHeader('Content-Type', 'application/json');
        }
    }

    public function listEvolucao($id_paciente)
    {
        $evolucoes = $this->evolucao->get_evolucoes($id_paciente, $this->user->id_user);
        $dados['links'] = $this->evolucao->links();
        $dados['evolucoes'] = $evolucoes;
        $this->view('user.table_evolucoes', $dados);
    }

    public function destroy($request, $response, $args)
    {
        $deleted = $this->evolucao->find('id_evolucao', $args['id'])->delete();
        if ($deleted) {
            return $response->withJson(array('true'));
        } else {
            return $response->withJson(array('false'));
        }
    }

    public function edit($request, $response, $args)
    {      
        $evolucao = $this->evolucao;
        $evolucao = $evolucao->select()->where('id_evolucao', $args['id'])->first();
        $this->view('user.cadastra_evolucao', [
            'acao' => 'Editar',
            'id_paciente' => $evolucao->id_paciente,
            'action' => "javascript:editarEvolucao(" . $args['id'] . ", " . $args['index'] . ");",
            'evolucao' => $evolucao,
        ]);
    }

    public function update($request, $response, $args)
    {
       
        $validate = new Validate;
        $data = $validate->validate([
            'descricao' => 'required',
            'data' => 'required',
        ]);
        
        if ($validate->hasErrors()) {
            return back();
        }
        $data->id_user = $this->user->id_user;
     
        $update = $this->evolucao->find('id_evolucao', $args['id'])->update((array) $data, 'id_evolucao');
        return $response->withJson(array($update));
    }

    public function rel($request, $response, $args)
    {
        $response->withHeader('Content-type', 'application/pdf');
        $dompdf = new Dompdf();
        $paciente = $this->paciente;
        $user = $this->user;
        $evolucao = $this->evolucao;
        $paciente = $paciente->select()->where('id_paciente', $args['id'])->first();

        $evolucoes = $evolucao->get_evolucoes($paciente->id_paciente, $user->id_user);
        $dados['paciente'] = $paciente;
        $dados['title'] = 'Evolução';
        $dados['evolucoes'] = $evolucoes;
        $html = $this->viewPdf('user.evolucao_rel', $dados);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $filename = sprintf($paciente->nome . '-%s.pdf', date('Y-m-d'));
        $dompdf->stream($filename);
    }
}
