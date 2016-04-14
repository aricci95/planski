<?php


class HomeController extends AppController
{
    public function render()
    {
        $this->view->setViewName('home/wHome');
        $this->view->setTitle('Bienvenue sur PlanSki.fr !');
        $this->view->render();
    }
}