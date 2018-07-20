<?php
namespace App\Model;

use App\Core\Model;

class Evolucao extends Model
{

    protected $table = 'evolucoes';

    public function get_evolucoes($id_paciente, $id_user)
    {   

        $this->select();
        $this->sql .= " where id_paciente = $id_paciente AND id_user = $id_user ";
        $this->orderBY('data,descricao', 'ASC');
        $this->paginate(5);
        return $this->get();
    }
}
