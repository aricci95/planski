<?php

abstract class Model
{

    protected $db;
    protected $context;

    public function __construct(Db $db)
    {
        $this->db      = $db;
        $this->context = Context::getInstance();
    }

    protected function _selectBuilder($table, $attributes_string = null, array $where = array(), array $orderBy = array(), $limit = null)
    {
        $sql = '
            SELECT
                ' . $attributes_string . '
            FROM
                ' . $table . '
            ';

        if (!empty($where)) {
            $sql .= ' WHERE TRUE ';

            foreach ($where as $key => $value) {
                if (strpos($key, '!') === 0) {
                    $key = str_replace('!', '', $key);
                    $sql .= " AND $key != :$key ";
                } else if (strpos($key, '%') === 0) {
                    $key = str_replace('%', '', $key);
                    $sql .= " AND $key LIKE :$key ";
                } else {
                    $sql .= " AND $key = :$key ";
                }
            }
        }

        if (!empty($orderBy)) {
            $sql .= ' ORDER BY ' . implode(',', $orderBy);
        }

        if (!empty($limit)) {
            $sql .= ' LIMIT ' . $limit;
        }

        $stmt = $this->db->prepare($sql);

        if (!empty($where)) {
            foreach ($where as $key => $value) {
                if (strpos($key, '%') === 0) {
                    $stmt->bindValue(str_replace('%', '', $key), '%' . $value . '%');
                } else {
                    $stmt->bindValue(str_replace('!', '', $key), $value);
                }
            }
        }

        return $this->db->executeStmt($stmt)->fetchAll();
    }

    protected function _updateBuilder($table, $attributes, $id)
    {
        if (is_array($attributes)) {
            $sql = 'UPDATE ' . $table . ' SET ';

            foreach ($attributes as $key => $value) {
                if (!is_int($key)) {
                    $sql .= $key . ' = ' . ':' . $key . ', ';
                }
            }

            $sql .= 'WHERE ' . $table . '_id = :id;';

            $sql = str_replace(', WHERE', ' WHERE', $sql);

            $stmt = $this->db->prepare($sql);

            foreach ($attributes as $key => $value) {
                if (!is_int($key)) {
                    $stmt->bindValue(':' . $key, $value);
                }
            }
        } else {
            $sql = 'UPDATE ' . $table . ' SET ' . $attributes . ' = :new_value WHERE ' . $table . '_id = :id;';

            $stmt = $this->db->prepare($sql);

            $stmt->bindValue(':new_value', $newValue);
        }

        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        return $this->db->executeStmt($stmt);
    }

    public function fetch($sql)
    {
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $this->db->executeStmt($stmt)->fetchAll();
    }

    public function fetchOnly($sql)
    {
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $this->db->executeStmt($stmt)->fetch();
    }

    public function execute($sql, array $params = array())
    {
        $stmt = $this->db->prepare($sql);

        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }

        return $this->db->executeStmt($stmt);
    }

    public function insertId()
    {
        return $this->db->lastInsertId();
    }

    public function securize($data)
    {
        if (is_numeric($data)) {
            return $data;
        } else {
            return htmlspecialchars($data, ENT_QUOTES);
        }
    }
}
