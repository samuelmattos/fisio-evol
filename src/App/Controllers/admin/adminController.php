<?php
namespace App\Controllers\admin;

use App\Core\Controller;
use App\Core\Login;
use App\Core\Validate;
use App\Model\Admin;
use App\Core\Redirect;

class adminController extends Controller
{
    public function index($request, $response)
    {
        return $response
            ->withStatus(404)
            ->withHeader('Content-Type', 'text/html')
            ->write(
                $this->view('error_404', ['title' => 'Erro', 'dados' => 'Erro'])
            );
    }

    public function store()
    {
        $validate = new Validate;

        $data = $validate->validate([
            'email' => 'required:email',
            'password' => 'required',
        ]);

        if ($validate->hasErrors()) {
            return back();
		}
		
        $login = new Login('admin');
        $loggedIn = $login->login($data, new Admin());
       
        if ($loggedIn) {
            Redirect::redirect('admin/painel');
        }
    }

    public function destroy()
    {
        $login = new Login('admin');
        return $login->logout();

    }
}
