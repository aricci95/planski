<?php
abstract class AppController extends Controller
{

    protected $_authLevel = AUTH_LEVEL_USER;

    public function __construct()
    {
        parent::__construct();

        $this->_checkSession();

        if (!$this->isAjax()) {
            $role_id = $this->context->get('role_id');

            if ($role_id >= AUTH_LEVEL_USER) {
                try {
                    $this->_getNotifications();
                    $this->_refreshLastConnexion();
                } catch (Exception $e) {
                    $this->view->growlerError();

                    $this->get('mailer')->sendError($e);
                }
            }
        }
    }

    private function _getNotifications()
    {
        // Vérification des nouveaux messages
        $oldMessagesCount  = $this->context->get('new_messages');

        $this->context->set('new_messages', $this->model->message->countNewMessages($this->context->get('user_id')));

        $this->context->set('notification', $this->model->query('notification')->select());

        if ($oldMessagesCount < $this->context->get('new_messages')) {
            $this->view->growler('Nouveau message !', GROWLER_INFO);
        }
    }

    protected function _refreshLastConnexion()
    {
        // Status
        if ($this->context->get('user_id')) {
            if ($this->context->get('user_last_connexion')) {
                $now      = time();
                $left     = $this->context->get('user_last_connexion');
                $timeLeft = $now - $left;

                if ($timeLeft == 0 || $timeLeft > (ONLINE_TIME_LIMIT - 300)) {
                    $this->model->User->updateLastConnexion($this->context->get('user_id'));
                }
            } else {
                $this->model->User->updateLastConnexion($this->context->get('user_id'));
            }
        }
    }

    // Vérifie la conformité de la session
    protected function _checkSession()
    {
        $roleLimit = $this->_authLevel;

        $socialAppsData = $this->context->get('userprofile');

        if (!empty($socialAppsData['email']) && $socialAppsData['verified']) {
            if (!$this->get('Facebook')->login()) {
                session_destroy();
                $this->redirect('subscribe');
            }
        }

        // Cas user en session
        if ($this->context->get('user_valid') && $this->context->get('user_id') && $this->context->get('user_mail')) {
            if ($this->context->get('user_valid') == 1) {
                if ($this->context->get('role_id') >= $roleLimit) {
                    return true;
                } else {
                    // Utilisateur valide mais droits insuffisants
                    $this->redirect('subscribe', array('msg' => ERR_AUTH));
                    die;
                }
            } else {
                // Message non validé
                session_destroy();
                $this->redirect('subscribe', array('msg' => ERR_NOT_VALIDATED));
            }
        } // Cas pas d'user en session, vérification des cookies
        elseif (!empty($_COOKIE['planskiEmail']) && !empty($_COOKIE['planskiPwd'])) {
            try {
                $logResult = $this->get('auth')->checkLogin($_COOKIE['planskiEmail'], $_COOKIE['planskiPwd']);
            } catch (Exception $e) {
                $this->redirect('subscribe', array('msg' => $e->getCode()));
            }

            return $logResult;
        } // Cas page accès sans autorisation
        elseif ($roleLimit != AUTH_LEVEL_NONE) {
            $this->redirect('subscribe', array('msg' => ERR_AUTH));
        }

        return false;
    }
}
