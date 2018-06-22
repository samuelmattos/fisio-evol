<?php

namespace App\Controllers;
use App\Core\Controller;

class registerController extends Controller
{
    public function index()
    {
        $this->data['dados'] = 'Register';
        $this->loadTemplate('Register', $this->getData());
    }
}
