<?php

namespace App\traits;
use App\load\Load;
trait View
{
    protected $twig;

    protected function twig()
    {
        $loader = new \Twig_Loader_Filesystem('src/App/Views');
        $this->twig = new \Twig_Environment($loader, array(
            'debug' => true,
        ));
    }

    protected function functions()
    {
        $functions = Load::file('/App/functions/twig.php');
        foreach($functions as $function){
            $this->twig->addFunction($function);
        }
    }

    protected function load()
    {
        $this->twig();
        $this->functions();
    }

    protected function view($view, $data)
    {
        $this->load();
        $template = $this->twig->loadTemplate(str_replace('.', '/', $view).'.html');
        return $template->display($data);
    }
}
