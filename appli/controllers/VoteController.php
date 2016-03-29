<?php

class VoteController extends AppController
{

    protected $_JS = array(JS_MODAL, JS_AUTOCOMPLETE);

    public function render()
    {
        $type = $this->context->getParam('value');
        $id   = $this->context->getParam('option');

        $this->view->user = $this->model->user->findOne(array('user_login'), array('user_id' => $id));

        $this->view->votes = $this->model->vote->get($type, $id);

        $this->view->setViewName('vote/wMain');
        $this->view->render('modalView');
    }
}
