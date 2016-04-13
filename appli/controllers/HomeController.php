<?php


class HomeController extends AppController
{
    protected $_type = SEARCH_TYPE_APPART;

    public function render()
    {
        $this->view->setViewName('home/wHome');
        $this->view->setTitle('Bienvenue sur PlanSki.fr !');
        $this->view->render();
    }
}