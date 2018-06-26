<?php

namespace App\Controllers;

use App\Core\Controller;

class homeController extends Controller
{
    public function index($request, $response)
    {
        $this->data['dados'] = 'home';
        $this->loadTemplate('Home', $this->getData());
    }
}
