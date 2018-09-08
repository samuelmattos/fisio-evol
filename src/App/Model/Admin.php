<?php
namespace App\Model;
use App\Core\Model;

class Admin extends Model
{
    public $typeLogin = 'admin';
    protected $table = 'admins';

    public function user()
    {
        if(!isset($_SESSION['id_admin'])){
            return false;
            throw new \Exception("Você não pode acessar essa página");            
        }
        $id = $_SESSION['id_admin'];
        $this->sql = "select * from {$this->table}";
        $this->where('idadmin', $id);

        return $this->first();
    }
}
