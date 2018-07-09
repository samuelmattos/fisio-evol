<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Model\User;
class homeController extends Controller
{
    public function index($request, $response)
    {
        $this->view('home', ['title' => 'home', 'dados' => 'home']);
    }
}
