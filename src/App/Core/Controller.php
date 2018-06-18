<?php
namespace App\Core;

class Controller
{
    protected $data = [];

    public function __construct()
    {

    }

    public function getData()
    {
        return $this->data;
    }

    public function __cal()
    {
        $this->loadTemplate('error_404');
    }

    public function loadView($viewName, $viewData = array())
    {
        extract($viewData);
        include 'App/views/' . $viewName . '.php';
    }

    public function loadTemplate($viewName, $viewData = array())
    {
        include 'App/views/template.php';
    }

    public function loadViewInTemplate($viewName, $viewData = array())
    {
        extract($viewData);
        include 'App/views/' . $viewName . '.php';
    }

    public function index()
    {
        $model = new Model;
        $view = new View;
        $view->render($model->getText());
    }
}
