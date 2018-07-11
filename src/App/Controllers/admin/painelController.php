<?php
namespace App\Controllers\admin;

use App\Core\Controller;

class painelController extends Controller
{
    public function index()
    {
        $this->view('admin.painel', []);
    }
}
