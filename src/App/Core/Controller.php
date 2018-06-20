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
        include 'src/App/Views/' . $viewName . '.php';
    }

    public function loadTemplate($viewName, $viewData = array())
    {
        include 'src/App/Views/Template.php';
    }
    public function loadViewInFooter($viewName, $viewData = array())
    {
        include 'src/App/Views/Footer.html';
    }
    public function loadViewInMenu($viewName, $viewData = array())
    {
        include 'src/App/Views/Menu.html';
    }

    public function loadViewInTemplate($viewName, $viewData = array())
    {
        extract($viewData);
        include 'src/App/Views/' . $viewName . '.php';
    }

    public function index()
    {
        $model = new Model;
        $view = new View;
        $view->render($model->getText());
    }
}
