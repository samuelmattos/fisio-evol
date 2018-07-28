<?php
namespace App\Controllers\user;
use App\Core\Controller;
use App\Core\Login;
use App\Core\Validate;
use App\Model\User;
use App\Core\Redirect;
use App\Core\Password;
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
        }else{
            return back();
        }
    }
    public function register(){
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
        if($user){
            $data->password = $old_pass;
            $login = new Login('user');
            $loggedIn = $login->login($data, new User());

            if ($loggedIn) {
                Redirect::redirect('user/pacientes');
            }else{
                return back();
            }
        }        
    }
    public function perfil()
    {
        $login = new Login('user');
        $this->view('user.perfil',[]);
    }
    public function destroy()
    {
        $login = new Login('user');
        return $login->logout();

    }
}
