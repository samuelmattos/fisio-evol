<?php
namespace App\Controllers\admin;

use App\Core\Controller;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Core\Login;
use App\Core\Redirect;
use App\Core\Validate;
use App\Model\Admin;

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

    public function store($request, $response)
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
            $target = 'admin/painel';
            return $response
                ->withHeader('Location', $target)->withStatus(302);
            // return Redirect::redirect('admin/painel', $request, $response);
        } else {
            return back();
        }
    }
    public function userEdit($request, $response, $args)
    {

    }

    public function userUpdate()
    {

    }
    public function destroy(Request $request, Response $response)
    {
        $login = new Login('admin');
        return $login->logout($request, $response);

    }
}
