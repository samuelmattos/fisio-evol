<?php
namespace App\Model;

use App\Core\Model;

class User extends Model
{
    public $typeLogin = 'user';
    protected $table = 'users';

    public function user()
    {
        if(!isset($_SESSION['id_user'])){
            return false;
            throw new \Exception("Você não pode acessar essa página");            
        }
        $id = $_SESSION['id_user'];
        $this->sql = "select * from {$this->table}";
        $this->where('id_user', $id);

        return $this->first();
    }
}
