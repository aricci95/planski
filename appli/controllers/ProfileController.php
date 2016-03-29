<?php

class ProfileController extends AppController
{

    protected $_JS = array(JS_MODAL, JS_AUTOCOMPLETE);

    public function render()
    {
        if (empty($this->context->params['value'])) {
            $this->redirect('user', array('msg' => ERR_BLACKLISTED));
        }

        // Récupération des informations de l'utilisateur
        $user = $this->model->User->getUserByIdDetails($this->context->params['value']);

        if (empty($user)) {
            $this->redirect('user', array('msg' => ERR_BLACKLISTED));
        }

        if ($this->context->get('user_id') != $this->context->params['value']) {
            $this->model->views->addView($this->context->params['value']);
        }

        $user['user_description'] = Tools::toSmiles($user['user_description']);

        if (empty($user['user_photo_url'])) {
            $user['user_photo_url'] = 'unknowUser.jpg';
        }

        $this->view->user = $user;

        $photos = $this->model->Photo->getPhotosByKey($this->context->params['value'], PHOTO_TYPE_USER);

        if (empty($photos)) {
            $photos = array(array('photo_url' => $user['user_photo_url']));
        }

        $this->view->photos = $photos;

        $this->view->setViewName('user/wMain');
        $this->view->render();
    }

    public function renderEdit()
    {
        $this->view->addJS(JS_DATEPICKER);

        $this->view->user = $this->model->User->getUserByIdDetails($this->context->get('user_id'));

        $this->view->setTitle('Edition du profil');
        $this->view->setViewName('user/wEdit');
        $this->view->render();
    }

    public function renderSave()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($this->context->params['user_login'])) {
            $this->context->params['user_login']             = Tools::no_special_character($this->context->params['user_login']);
            $this->context->params['user_description']       = htmlspecialchars($this->context->params['user_description'], ENT_QUOTES, 'utf-8');
            $this->context->params['user_profession']        = htmlspecialchars($this->context->params['user_profession'], ENT_QUOTES, 'utf-8');

            // On vérifie si le mdp est ok
            if ($this->context->params['user_pwd'] != $this->context->params['verif_pwd']) {
                $this->view->growler("les deux mots de passes ne sont pas identiques.", GROWLER_ERR);
            } else {
                if (!empty($this->context->params['user_pwd'])) {
                    $this->context->params['user_pwd'] = md5($this->context->params['user_pwd']);
                }

                // On formate la date de naissance
                if (!empty($this->context->params['user_birth'])) {
                    $dt = DateTime::createFromFormat('d/m/Y', $this->context->params['user_birth']);
                    $this->context->params['user_birth'] = $dt->format("Y-m-d");
                }

                $user_data = $this->context->params;

                unset($user_data['user_id']);
                unset($user_data['verif_pwd']);
                unset($user_data['user_profession']);

                if ($this->model->user->updateById($user_data, $this->context->getParam('user_id'))) {
                    $ville = $this->model->city->findOne(array('ville_longitude_deg', 'ville_latitude_deg'), array('ville_id' => $this->context->getParam('ville_id')));

                    $this->context->set('ville_longitude_deg', $ville['ville_longitude_deg']);
                    $this->context->set('ville_latitude_deg', $ville['ville_latitude_deg']);

                    $this->view->growler('Modifications enregistrées', GROWLER_OK);
                } else {
                    $this->view->growlerError();
                }
            }
        }

        $this->renderEdit();
    }

    public function renderDelete()
    {
        // Suppression de l'utilisateur
        if ($this->get('user')->delete($this->context->get('user_id'))) {

            //Destruction du Cookie
            setcookie("planskiPwd", 0);
            setcookie("planskiLogin", 0);
            session_destroy();

            // redirection
            $this->redirect('user', array('msg' => MSG_ACCOUNT_DELETED));
        } else {
            $this->_view->growlerError();
            $this->render();
        }
    }
}
