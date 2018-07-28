<?php
namespace App\Model;

use App\Core\Model;

class Evolucao extends Model
{

    protected $table = 'evolucoes';

    public function get_evolucoes($id_paciente, $id_user)
    {   
        $this->sql .= "select id_evolucao, descricao, DATE_FORMAT(data, '%d/%m/%Y') data, id_paciente, id_user, eva from $this->table ";
        $this->sql .= " where id_paciente = $id_paciente AND id_user = $id_user ";
        $this->orderBY('data,descricao', 'ASC');
        $this->paginate(5);
        return $this->get();
    }
}
