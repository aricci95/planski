<?php

class MailerService extends Service
{

    public function send($email, $title, $content, $additionnalContent = true)
    {
        // HEADERS
        $headers = 'From: "PlanSki"<contact.planski@gmail.com>' . "\n";
        $headers .='Reply-To: contact.planski@gmail.com' . "\n";
        $headers .='Content-Type: text/html; charset="utf-8"' . "\n";
        $headers .='Content-Transfer-Encoding: 8bit';

        $previousContent = 'Hail Metalhead !<br><br>';

        if ($additionnalContent) {
            $content = $previousContent.$content;
            $content .= '<br><br>Bien cordialement, <br><br> L\'équipe <a href="http://planski.fr">PlanSki</a>.';
        }

        if (MAIL_SERVER) {
            return mail($email, $title, $content, $headers);
        } else {
            echo '<div style="background-color:white;">';
            echo $content;
            echo '</div>';

            return true;
        }
    }

    public function sendError($exception)
    {
        $errorName = 'Erreur inconnue';

        $errorType = array(
           E_ERROR => 'Fatal error',
           E_WARNING => 'Warning',
           E_PARSE => 'Parse error',
           E_NOTICE => 'Notice',
           ERROR_SQL => 'SQL',
           ERROR_BEHAVIOR => 'Behavior',
        );

        if (!empty($errorType[$exception->getCode()])) {
            $errorName = $errorType[$exception->getCode()];
        }

        $sessionDatas = "<br/><br/>Valeurs de session : <br/>";

        if ($this->context->get('user_id')) {
            $sessionDatas .= 'user_id => '.$this->context->get('user_id').'<br/>';
        }

        if ($this->context->get('user_prenom')) {
            $sessionDatas .= 'user_prenom => '.$this->context->get('user_prenom').'<br/>';
        }

        if ($this->context->get('user_valid')) {
            $sessionDatas .= 'user_valid => '.$this->context->get('user_valid').'<br/>';
        }

        $message = nl2br('<b>Erreur '.$errorName.' :</b>'.
                        '<br/><br/>'.$exception->getMessage().
                        '<br/><br/>'.$sessionDatas.
                        '<br/><br/>Stack :<br/>'.
                        $exception->getTraceAsString());

        Log::err(str_replace(array('<br/>', '<b>', '</b>', '<br />'), array("\n", '', '', ''), $message));

        return $this->send(ADMIN_MAIL, 'Erreur sur PlanSki !', $message, false);
    }
}
