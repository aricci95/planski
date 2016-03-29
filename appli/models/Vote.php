<?php

class Vote extends AppModel
{
    const TYPE_USER = 1;

    public static $types = array(
        self::TYPE_USER => 'user',
    );

    public function get($type_id, $key_id)
    {
        $sql = 'SELECT
            *
            FROM vote
            JOIN user ON (vote.key_id = user.user_id)
            WHERE type_id = :type_id
            AND key_id = :key_id
            ORDER BY vote_date DESC;
        ';

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue('type_id', $type_id, PDO::PARAM_INT);
        $stmt->bindValue('key_id', $key_id, PDO::PARAM_INT);

        return $this->db->executeStmt($stmt)->fetchAll();
    }

    public function add(array $data)
    {

    }
}
