<?php
class AuthController extends AppController
{

    protected $_authLevel = AUTH_LEVEL_NONE;

    public function renderLogin()
    {
        if (!empty($this->context->params['user_mail']) && !empty($this->context->params['user_pwd'])) {
            try {
                $authentResult = $this->get('auth')->login($this->context->params['user_mail'], $this->context->params['user_pwd']);

                if ($authentResult) {
                    $this->redirect('crew');
                }
            } catch (Exception $e) {
                Log::err($e->getMessage());
                $this->redirect('subscribe', array('msg' => $e->getCode()));
            }
        }

        $this->redirect('subscribe', array('msg' => ERR_LOGIN));
    }

    public function renderDisconnect()
    {
        if ($this->get('auth')->disconnect()) {
            $this->redirect('subscribe');
        } else {
            $this->view->growlerError();
        }
    }
}
