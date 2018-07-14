<?php
namespace App\Controllers\user;
use App\Core\Controller;
use App\Core\Login;
use App\Core\Validate;
use App\Model\User;
use App\Core\Redirect;

class userController extends Controller
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
		
        $login = new Login('user');
        $loggedIn = $login->login($data, new User());
     
        if ($loggedIn) {
            Redirect::redirect('user/pacientes');
        }
    }

    public function destroy()
    {
        $login = new Login('user');
        return $login->logout();

    }
}
