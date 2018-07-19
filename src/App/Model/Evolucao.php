<?php
namespace App\Model;

use App\Core\Model;

class Evolucao extends Model
{

    protected $table = 'evolucoes';

    public function get_evolucoes()
    {       
        $this->select();
        $this->busca('nome,telefone');
        $this->orderBY('data,id_evolucao', 'ASC');
        $this->paginate(5);

        return $this->get();
    }
}
