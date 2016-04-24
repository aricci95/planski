<?php

class LocationController extends AppController
{
    protected $_authLevel = array(
        Auth::ROLE_OWNER,
        Auth::ROLE_ADMIN,
    );

    public function renderEdit()
    {
        $this->view->addJS(JS_EDIT);

        $this->view->setTitle('Ma location');
        $this->view->setViewName('location/wEdit');
        $this->view->render();
    }
}