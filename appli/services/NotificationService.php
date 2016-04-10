<?php

class NotificationService extends Service
{

    public function notify($action, $targetId)
    {
        if ($targetId == Notification::ACTION_COMMENT) {
            $link = 'plan/feed/' . $targetId . '#comments-container';
        } else {
            throw new Exception('Action inconnue.', 1);
        }

        $content = sprintf(Notification::$messages[$action], ucfirst($this->context->get('user_prenom')));

        $notification = array(
            'notification_content' => $content,
            'notification_date' => time(),
            'notification_photo_url' => $this->context->get('user_photo_url'),
            'notification_link' => $link,
            'user_id' => $this->context->get('user_id'),
        );

        return $this->model->query('notification')->insert($notification);
    }
}
