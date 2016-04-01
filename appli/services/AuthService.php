<?php

class AuthService extends Service
{

    public function login($email, $pwd)
    {
        $email = trim($this->context->params['user_mail']);

        $logResult = $this->checkLogin($email, md5($this->context->params['user_pwd']));

        if ($logResult) {
            if ($this->context->getParam('savepwd') == 'on') {
                setcookie('planskiEmail', $this->context->getParam('user_prenom'), time() + 365*24*3600, '/', null, false, true);
                setcookie('planskiPwd', md5($this->context->getParam('user_pwd')), time() + 365*24*3600, '/', null, false, true);
            } else {
                setcookie('planskiEmail', 0, time(), '/', false, true);
                setcookie('planskiPwd', 0, time(), '/', false, true);
            }

            return true;
        }

        return false;
    }

    public function checkLogin($email, $pwd)
    {
        $user = $this->model->user->findByEmailPwd($email, $pwd);

        if (!empty($user['user_mail']) && !empty($user['user_id']) && strtolower($user['user_mail']) == strtolower($email) && $email != '') {
            if ($user['user_valid'] != 1) {
                throw new Exception("Email non validé", ERR_MAIL_NOT_VALIDATED);
            } elseif ($user['role_id'] > 0) {
                if (empty($user['ville_id'])) {
                    $localization = $this->get('geoloc')->localize();

                    if (!empty($localization->postal_code)) {
                        $ville = $this->query('city')
                                      ->single()
                                      ->where(array('%ville_code_postal' => $localization->postal_code))
                                      ->select(array('ville_longitude_deg', 'ville_latitude_deg', 'ville_id'));

                        $this->query('user')->updateById($user['user_id'], array('ville_id' => $ville['ville_id']));
                    }
                } else {
                    $ville = $this->query('city')
                                  ->single()
                                  ->where(array('ville_id' => $user['ville_id']))
                                  ->select(array('ville_longitude_deg', 'ville_latitude_deg'));
                }

                $this->model->user->updateLastConnexion();

                if (!empty($ville)) {
                    $user['ville_longitude_deg'] = $ville['ville_longitude_deg'];
                    $user['ville_latitude_deg'] = $ville['ville_latitude_deg'];
                }

                return $this->authenticateUser($user);
            }
        } else {
            throw new Exception("Mauvais email / mot de passe", ERR_LOGIN);
        }

        return false;
    }

    public function authenticateUser(array $user)
    {
        $this->context->set('user_id', (int) $user['user_id'])
                      ->set('user_prenom', $user['user_prenom'])
                      ->set('user_pwd', $user['user_pwd'])
                      ->set('user_last_connexion', time())
                      ->set('role_id', (int) $user['role_id'])
                      ->set('user_photo_url', empty($user['user_photo_url']) ? 'unknown.png' : $user['user_photo_url'])
                      ->set('age', (int) $user['age'])
                      ->set('user_valid', (int) $user['user_valid'])
                      ->set('user_mail', $user['user_mail'])
                      ->set('user_gender', (int) $user['user_gender'])
                      ->set('ville_id', (int) $user['ville_id'])
                      ->set('ville_longitude_deg', $user['ville_longitude_deg'])
                      ->set('ville_latitude_deg', $user['ville_latitude_deg'])
                      ->set('forum_notification', $user['forum_notification']);
        return true;
    }

    public function sendPwd($login = null, $email = null)
    {
        if (empty($login) && empty($email)) {
            return false;
        }

        $param = empty($login) ? 'user_mail' : 'user_prenom';
        $value = empty($login) ? $email : $login;

        $user = $this->query('user')
                     ->single()
                     ->where(array($param => $value))
                     ->select(array('user_id', 'user_prenom', 'user_mail'));

        if (!empty($user['user_prenom'])) {
            $pwd_valid = $this->model->auth->resetPwd($user['user_id']);

            $message = 'Pour modifier ton mot de passe clique sur le lien suivant : <a href="http://www.planski.fr/lostpwd/new/' . $pwd_valid . '">modifier mon mot de passe</a>';

            return $this->get('mailer')->send($user['user_mail'], 'Modifcation du mot de passe PlanSki', $message);
        } else {
            return false;
        }
    }

    public function disconnect()
    {
        setcookie('planskiEmail', 0, time(), '/', false, true);
        setcookie('planskiPwd', 0, time(), '/', false, true);

        $this->context->destroy();

        return true;
    }
}
