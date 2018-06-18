<?php

class homeController extends Controller
{
    public function index()
    {
        $this->data['dados'] = 'home';
        $this->loadTemplate('home', $this->getData());
    }
}
