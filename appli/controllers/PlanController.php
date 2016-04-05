<?php

require_once ROOT_DIR . '/appli/controllers/SearchController.php';

class PlanController extends SearchController
{

    protected $_type = SEARCH_TYPE_PLAN;

    protected $_searchParams = array(
        'search_libel',
    );

    public function render()
    {
        $this->view->addJS(JS_CREW);

        parent::render();
    }

    public function renderFeed()
    {
        $this->view->addJS(JS_FEED);

        $this->view->plan = $this->model->plan->getById($this->context->getParam('value'));

        $this->view->current_step = 3;

        $this->view->steps = $this->model->query('step')->select();

        $this->view->setTitle($this->view->plan['crew_name']);
        $this->view->setViewName('plan/wMain');
        $this->view->render();
    }

}
