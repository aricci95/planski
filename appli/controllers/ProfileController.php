<?php

class ProfileController extends AppController
{

    public function render()
    {
        $userId = $this->context->getParam('value');

        $this->view->user = $this->model->user->getUserByIdDetails($userId);

        $this->view->setViewName('user/wItem');
        $this->view->render('modalView');
    }

    public function renderEdit()
    {
        $this->view->addJS(JS_DATEPICKER);
        $this->view->addJS(JS_EDIT);
        $this->view->addJS(JS_AUTOCOMPLETE);

        $this->view->user = $this->model->User->getUserByIdDetails($this->context->get('user_id'));

        $this->view->setViewName('user/wEdit');
        $this->view->render();
    }

    public function renderChange()
    {
        $data = array(
            $this->context->getParam('name') => $this->context->getParam('value'),
        );

        if($this->model->user->updateUserData($data)) {
            $this->view->growler("Modification enregistrée.", GROWLER_OK);
        } else {
            $this->view->growlerError();
        }

        $this->view->setViewName('user/wEdit');
        $this->view->render();
    }

    public function renderSave()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->context->params['user_description'] = htmlspecialchars($this->context->params['user_description'], ENT_QUOTES, 'utf-8');
            $this->context->params['user_profession']  = htmlspecialchars($this->context->params['user_profession'], ENT_QUOTES, 'utf-8');

            // On vérifie si le mdp est ok
            if ($this->context->params['user_pwd'] != $this->context->params['verif_pwd']) {
                $this->view->growler("les deux mots de passes ne sont pas identiques.", GROWLER_ERR);
            } else {
                foreach ($this->context->params as $key => $param) {
                    if (empty($param)) {
                        unset($this->context->params[$key]);
                    }
                }

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
                unset($user_data['user_profession']);

                if ($this->model->query('user')->updateById($this->context->get('user_id'), $user_data)) {
                    if (!empty($this->context->getParam('ville_id'))) {
                        $ville = $this->model->query('city')
                                      ->single()
                                      ->where(array('ville_id' => $this->context->getParam('ville_id')))
                                      ->select(array('ville_longitude_deg', 'ville_latitude_deg'));

                        $this->context->set('ville_longitude_deg', $ville['ville_longitude_deg']);
                        $this->context->set('ville_latitude_deg', $ville['ville_latitude_deg']);
                    }

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
            setcookie("planskiEmail", 0);
            session_destroy();

            // redirection
            $this->redirect('user', array('msg' => MSG_ACCOUNT_DELETED));
        } else {
            $this->_view->growlerError();
            $this->render();
        }
    }
}
