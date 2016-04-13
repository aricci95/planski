<?php

require_once ROOT_DIR . '/appli/controllers/SearchController.php';

class CrewController extends SearchController
{
    protected $_authLevel = array(
        Auth::ROLE_SKI,
        Auth::ROLE_ADMIN,
    );

    protected $_type = SEARCH_TYPE_CREW;

    protected $_searchParams = array(
        'search_name',
        'search_distance',
        'search_gender',
        'search_age',
    );

    public function render()
    {
        $this->view->addJS(JS_CREW);

        parent::render();
    }

}