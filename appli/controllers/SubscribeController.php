<?php

class SubscribeController extends AppController
{

    protected $_authLevel = array();

    public function __construct()
    {
        parent::__construct();

        if ($this->context->get('user_id')) {
            $this->redirect('user');
        }
    }

    public function render()
    {
        $socialAppsData = $this->context->get('userprofile');

        if (empty($this->context->params) && !empty($socialAppsData['email'])) {
            $this->context->params['user_mail']   = $socialAppsData['email'];
            $this->context->params['user_prenom'] = ucfirst(trim($socialAppsData['last_name']));
            $this->context->params['user_nom']    = ucfirst(trim($socialAppsData['first_name']));
            $this->context->params['user_gender'] = ($socialAppsData['gender'] == 'male') ? '1' : '2';
        }

        $this->view->setViewName('main/wSubscribe');
        $this->view->setTitle('Inscription');
        $this->view->render();
    }

    private function _isValid()
    {
        // Champs vides
        $inputs = array('user_prenom', 'user_nom', 'user_pwd', 'verif_pwd', 'user_mail', 'role_id');

        foreach ($inputs as $input) {
            if (empty($this->context->params[$input])) {
                $this->view->growler('Tous les champs sont obligatoires.');
                return false;
            }
        }

        if ($this->context->getParam('role_id') > Auth::ROLE_OWNER) {
            $this->view->growler('Une erreur c\'est produite.');
            return false;
        }

        $this->context->params['user_prenom'] = trim($this->context->params['user_prenom']);

        if (strlen($this->context->params['user_prenom']) > 20) {
            $this->view->growler('Le prénom doit faire moins de 20 caractères.');
            return false;
        }

        if (strlen($this->context->params['user_nom']) > 20) {
            $this->view->growler('Le nom doit faire moins de 20 caractères.');
            return false;
        }

        // Message
        $Syntaxe='#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#';
        if (!preg_match($Syntaxe, $this->context->params['user_mail'])) {
            $this->view->growler('Adresse e-message invalide.');
            return false;
        }

        if ($this->model->User->isUsedEmail($this->context->params['user_mail'])) {
            $this->view->growler('Adresse e-message déjà utilisée.');
            return false;
        }

        // Password
        if (strlen($this->context->params['user_pwd']) < 8) {
            $this->view->growler('Le mot de passe doit comporter au moins 8 caractères.');
            return false;
        }

        if ($this->context->params['user_pwd'] != $this->context->params['verif_pwd']) {
            $this->view->growler('La vérification du mot de passe est érronnée.');
            return false;
        }

        return true;
    }

    public function renderSave()
    {
        $this->context->delete('userprofile');

        $contextUserId = $this->context->get('user_id');

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && empty($contextUserId)) {
            if ($this->_isValid()) {
                $newUser['user_prenom'] = $this->context->params['user_prenom'];
                $newUser['user_nom']    = $this->context->params['user_nom'];
                $newUser['user_pwd']    = md5($this->context->params['user_pwd']);
                $newUser['user_mail']   = $this->context->params['user_mail'];
                $newUser['user_gender'] = $this->context->params['user_gender'];
                $newUser['user_type']   = $this->context->params['user_type'];
                $newUser['role_id']   = $this->context->getParam('role_id');

                $validationId = $this->model->User->createUser($newUser);

                if (!empty($validationId)) {
                    $message = 'Merci de vous être inscris sur PlanSki<br><br>
                            Avant de pouvoir vous connecter vous devez cliquer sur ce lien pour valider votre adresse message :<br><br>
                            <a href="http://planski.fr/subscribe/validate/' . $validationId . '">Cliquez ici pour valider votre compte ! </a><br><br>
                            Voici vos identifiants :<br><br>
                            <u>Login :</u> ' . $newUser['user_mail'] . '<br><br>
                            <u>Mot de passe :</u> ' . $this->context->params['user_pwd'] . '<br><br>
                            Si vous rencontrez des problèmes, n\'hésitez pas à nous envoyer un message en répondant directement à celui-ci, nous vous répondrons dans les plus bref délais.';
                    if ($this->get('mailer')->send($newUser['user_mail'], 'Bienvenue sur PlanSki ' . $newUser['user_prenom'] . ' !', $message)) {
                        $this->redirect('subscribe', array('msg' => MSG_VALIDATION_SENT));
                    } else {
                        $this->view->growlerError();
                    }
                    return;
                } else {
                    $this->view->growlerError();
                }
            }
        }

        $this->render();
    }

    public function renderValidate()
    {
        if (!empty($this->context->params['value'])) {
            if ($this->model->User->setValid($this->context->params['value'])) {
                $this->redirect('subscribe', array('msg' => MSG_VALIDATION_SUCCESS));
            } else {
                $this->redirect('subscribe', array('msg' => ERR_VALIDATION_FAILURE));
            }
        } else {
            $this->redirect('subscribe', array('msg' => ERR_VALIDATION_FAILURE));
        }
    }

    public function renderTerms()
    {
        $this->view->setTitle('Mentions Légales');
        $this->view->setViewName('main/wTerms');
        $this->view->render();
    }
}
