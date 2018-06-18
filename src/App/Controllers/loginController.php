<?php

namespace App\Controllers;
use App\Core\Controller;

class loginController extends Controller
{
    public function index()
    {
        $this->data['dados'] = 'login';
        $this->loadTemplate('login', $this->getData());
    }
}
