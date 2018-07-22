<?php
namespace App\Model;

use App\Core\Model;
use App\Model\User;

class Pacientes extends Model
{

    protected $table = 'pacientes';

    public function get_pacientes()
    {
        $user = (new User)->user();
        $this->sql .= "select p.* from {$this->table} as p ";
        $this->sql .= "INNER JOIN paciente_user pu
        ON pu.id_paciente = p.id_paciente
        INNER JOIN users u
        ON u.id_user =  $user->id_user";
        $this->busca('p.nome,p.telefone');
        $this->orderBY('nome,id_paciente', 'ASC');

        $this->paginate(5);

        return $this->get();
    }

    public function add_paciente_user($id_paciente)
    {
        $user = (new User)->user();

        $sql = " INSERT INTO paciente_user (id_user, id_paciente) VALUES ($user->id_user, $id_paciente)";
        $coon = $this->connect->prepare($sql);

        return $coon->execute();
    }
}
