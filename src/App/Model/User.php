<?php
namespace App\Model;

use App\Core\Model;

class User extends Model
{
    public $typeLogin = 'user';
    protected $table = 'users';
}
