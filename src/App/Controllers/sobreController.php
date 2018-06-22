<?php

namespace App\Controllers;
use App\Core\Controller;

class sobreController extends Controller
{
    public function index()
    {
        $this->data['dados'] = 'sobre';
        $this->loadTemplate('sobre', $this->getData());
    }
}
