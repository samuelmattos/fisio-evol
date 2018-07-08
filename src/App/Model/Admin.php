<?php 
namespace App\Model;
use App\Core\Model;

class Admin extends Model{
    public $typeLogin = 'admin';
    protected $table = 'admins';
}