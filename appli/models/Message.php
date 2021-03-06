<?php

class Message extends Model
{

    public function countNewMessages()
    {
        $sql = "SELECT count(*) as nbr
                FROM
                    message
                WHERE
                    destinataire_id = :context_user_id
                AND state_id = :message_status_sent
            ;";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue('context_user_id', $this->context->get('user_id'), PDO::PARAM_INT);
        $stmt->bindValue('message_status_sent', MESSAGE_STATUS_SENT, PDO::PARAM_INT);

        $resultat = $this->db->executeStmt($stmt)->fetch();

        return $resultat['nbr'];
    }

    public function updateMessageState($messageId, $messageStateId)
    {
        $sql = "UPDATE message SET state_id = :message_state_id
                WHERE message_id = :message_id";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue('message_state_id', $messageStateId, PDO::PARAM_INT);
        $stmt->bindValue('message_id', $messageId, PDO::PARAM_INT);

        return $this->db->executeStmt($stmt);
    }

    // Récupère l'ensemble de la conversation
    public function getConversation($userId, $offset = 0)
    {
        $start = ($offset * NB_MESSAGE_RESULTS);
        $stop  = NB_MESSAGE_RESULTS;

        $sql = '
            SELECT
                message_id,
                user.user_id as user_id,
                expediteur_id,
                destinataire_id,
                user_prenom,
                user_gender,
                content,
                UNIX_TIMESTAMP(user_last_connexion) as user_last_connexion,
                date,
                UNIX_TIMESTAMP( date ) AS delais,
                user_photo_url,
                state_libel,
                message.state_id as state_id
            FROM
                message
            JOIN user ON (user.user_id = message.expediteur_id)
            JOIN ref_message_state ON (ref_message_state.state_id = message.state_id)
            WHERE expediteur_id IN (:context_user_id, :user_id)
            AND destinataire_id IN (:context_user_id, :user_id)
            AND message.state_id IN (:status_sent, :status_read)
            ORDER BY date DESC
            LIMIT :limit_start, :limit_stop
            ;
        ';

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue('context_user_id', $this->context->get('user_id'), PDO::PARAM_INT);
        $stmt->bindValue('user_id', $userId, PDO::PARAM_INT);
        $stmt->bindValue('status_sent', MESSAGE_STATUS_SENT, PDO::PARAM_INT);
        $stmt->bindValue('status_read', MESSAGE_STATUS_READ, PDO::PARAM_INT);
        $stmt->bindValue('limit_start', $start, PDO::PARAM_INT);
        $stmt->bindValue('limit_stop', $stop, PDO::PARAM_INT);

        if (!$stmt->execute()) {
            $error_message = $stmt->errorInfo();
            throw new Exception('La requête suivante : <b><br/>' . $sql . '</b><br/><br/>a renvoyé une erreur :<br/><i>' . $error_message[2] . '<i>', ERROR_SQL);
        }

        return $stmt->fetchAll();
    }

    // Supprime un message
    public function deleteMessageById($messageId)
    {
        $sql = "DELETE FROM message WHERE message_id = '".$this->securize($messageId)."';";
        $resultat = $this->execute($sql, false);
        return $resultat;
    }

    // Supprime toute une conversation
    public function deleteConversation($linkId)
    {
        $catchSql = "SELECT * FROM message WHERE message_id = '".$this->securize($linkId)."';";
        $catch = $this->fetchOnly($catchSql);

        $sql = "DELETE FROM message
                WHERE destinataire_id IN ('".$catch['destinataire_id']."', '".$catch['expediteur_id']."')
                AND expediteur_id IN ('".$catch['destinataire_id']."', '".$catch['expediteur_id']."')";

        return $this->execute($sql);
    }

    public function getList($offset = 0)
    {
        $sql = "SELECT
                    user.user_id as user_id,
                    message.message_id as message_id,
                    user_prenom,
                    user_gender,
                    expediteur_id,
                    state_libel,
                    UNIX_TIMESTAMP(user_last_connexion) as user_last_connexion,
                    message.state_id as state_id,
                    LEFT(content, 300) as content,
                    UNIX_TIMESTAMP( date ) AS delais,
                    user_photo_url
                FROM
                    message JOIN user ON (message.expediteur_id = user.user_id)
                            JOIN ref_message_state ON (ref_message_state.state_id = message.state_id)
                WHERE
                     destinataire_id = :context_user_id
                ORDER BY date DESC
                LIMIT :limit_begin, :limit_stop
            ;";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue('context_user_id', $this->context->get('user_id'), PDO::PARAM_INT);
        $stmt->bindValue('limit_begin', ($offset * NB_MAILBOX_RESULTS), PDO::PARAM_INT);
        $stmt->bindValue('limit_stop', NB_MAILBOX_RESULTS, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $rawResults = $stmt->fetchAll();

            if (count($rawResults) > 0) {

                foreach ($rawResults as $key => $message) {
                    if (!isset($results[$message['user_id']])) {
                        $results[$message['user_id']] = $message;
                    }
                }

                return $results;
            }
        } else {
            $error_message = $stmt->errorInfo();
            throw new Exception('La requête suivante : <b><br/>' . $sql . '</b><br/><br/>a renvoyé une erreur :<br/><i>' . $error_message[2] . '<i>', ERROR_SQL);
        }

       return array();
    }
}
