<?php

class VoteController extends AppController
{

    protected $_JS = array(JS_MODAL, JS_AUTOCOMPLETE);

    public function render()
    {
        $type = $this->context->getParam('value');
        $id   = $this->context->getParam('option');

        $votes = $this->model->vote->get($type, $id);

        if (!empty($votes)) {
            $this->view->votes = $votes;
        } else {
            $this->view->growler('Aucun vote.');
        }

        $this->view->setViewName('vote/wMain');
        $this->view->render('modalView');
    }
}
