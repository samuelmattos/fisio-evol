<?php
namespace App\Core;
use Twig_Loader_Filesystem, Twig_Environment;

class Controller
{
    protected $data = [];
    protected $views = 'src/App/Views/';
    protected $cache = 'src/App/Storage/Cache/';

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
        $loader = new Twig_Loader_Filesystem($this->views);
        $twig = new Twig_Environment($loader);
        echo $twig->render($viewName.'.php', $viewData);
    }

    public function loadTemplate($viewName, $viewData = array())
    {
        include 'src/App/Views/Template.php';
    }

    public function loadViewInHtml($viewName, $viewData = array())
    {
        extract($viewData);
        $loader = new Twig_Loader_Filesystem($this->views);
        $twig = new Twig_Environment($loader, array(
            'cache' => $this->cache,
        ));
        echo $twig->render($viewName.'.html', $viewData);
    }
}
