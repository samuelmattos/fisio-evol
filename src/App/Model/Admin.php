<?php
namespace App\Model;
use App\Core\Model;

class Admin extends Model
{
    public $typeLogin = 'admin';
    protected $table = 'admins';

    public function user()
    {
        $id = $_SESSION['id_admin'];
        $this->sql = "select * from {$this->table}";
        $this->where('idadmin', $id);

        return $this->first();
    }
}
