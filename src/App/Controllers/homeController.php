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
    
    public function remenber()
    {
        $this->view('remenber');
    }

    public function mail_send($request, $response, $args)
    {        
        $email = $args['email'];
        $user = new User();
        $findUser = $user->findBy('email', $email);
        $nova_senha = mt_rand();
       
        return json_encode(['dados'=>$email]);
    }
}
