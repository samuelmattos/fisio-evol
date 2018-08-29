<?php
namespace App\Controllers\user;

use App\Core\Controller;
use App\Core\Login;
use App\Core\Password;
use App\Core\Redirect;
use App\Core\Validate;
use App\Model\User;

class userController extends Controller
{
    private $user;
    
    public function __construct()
    {
        $this->user = (new User)->user();
    }

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
        } else {
            Redirect::redirect('userLogin');
        }
    }
    public function register()
    {
        $validate = new Validate;

        $data = $validate->validate([
            'email' => 'required:email',
            'password' => 'required',
        ]);

        if ($validate->hasErrors()) {
            return back();
        }
        $old_pass = $data->password;
        $data->password = Password::make($old_pass);
        $user = new User();
        $user = $user->create((array) $data);
        if ($user) {
            $data->password = $old_pass;
            $login = new Login('user');
            $loggedIn = $login->login($data, new User());

            if ($loggedIn) {
                Redirect::redirect('user/pacientes');
            } else {
                return back();
            }
        }
    }

    public function perfil()
    {
        $login = new Login('user');
        $this->view('user.perfil', []);
    }

    public function update($request, $response, $data)
    {
        $validate = new Validate;
        $data = $validate->validate([
            'email' => 'required:email',
        ]);

        if ($validate->hasErrors()) {
            return back();
        }
        $old_pass = $data->password;
        $data->password = Password::make($old_pass);
        $user = new User();
        $update = $user->find('id_user', $this->user->id_user)->update((array) $data, 'id_user');
        Redirect::redirect('user/perfil');
        //return json_encode(array($update));
    }

    public function destroy()
    {
        $login = new Login('user');
        return $login->logout();
    }
}
