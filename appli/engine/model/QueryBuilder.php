<?php

class QueryBuilder
{
    protected $db;

    public $sql;
    public $stmt;
    public $table;
    public $where;
    public $orderBy;
    public $limit;
    public $single;

    public function __construct($table)
    {
        $this->db = Model_Manager::getInstance()->getConn();
        $this->table($table);
    }

    private function _cleanIndex($results)
    {
        foreach ($results as $key => $objects) {
            foreach ($objects as $index => $object) {
                if (is_int($index)) {
                    unset($results[$key][$index]);
                }
            }
        }

        return $results;
    }

    public function table($table)
    {
        $this->table   = trim(strtolower($table));

        return $this;
    }

    public function select(array $attributes = array())
    {
        $attributes_string = empty($attributes) ? '*' : implode(',', $attributes);

        $this->sql = '
            SELECT
                ' . $attributes_string . '
            FROM
                ' . $this->table . '
            ';

        if (!empty($this->join)) {
            foreach ($this->join as $key => $value) {
                if (is_int($key)) {
                    $this->sql .= ' JOIN ' . $value . ' ON (' . $this->table . '.' . $this->table . '_id = ' . $value . '.' . $value . '_id) ';
                } else {
                    $this->sql .= ' JOIN ' . $key . ' ON (' . $this->table . '.' . $this->table . '_id = ' . $key . '.' . $value . ') ';
                }
            }
        }

        if (!empty($this->where)) {
            $this->sql .= ' WHERE TRUE ';

            foreach ($this->where as $key => $value) {
                if (strpos($key, '!') === 0) {
                    $key = str_replace('!', '', $key);
                    $this->sql .= " AND $key != :$key ";
                } else if (strpos($key, '%') === 0) {
                    $key = str_replace('%', '', $key);
                    $this->sql .= " AND $key LIKE :$key ";
                } else {
                    $this->sql .= " AND $key = :$key ";
                }
            }
        }

        if (!empty($this->orderBy)) {
            $this->sql .= ' ORDER BY ' . implode(',', $this->orderBy);
        }

        if (!empty($this->limit)) {
            $this->sql .= ' LIMIT ' . $this->limit;
        }

        $this->stmt = $this->db->prepare($this->sql);

        if (!empty($this->where)) {
            foreach ($this->where as $key => $value) {
                if (strpos($key, '%') === 0) {
                    $this->stmt->bindValue(str_replace('%', '', $key), '%' . $value . '%');
                } else {
                    $this->stmt->bindValue(str_replace('!', '', $key), $value);
                }
            }
        }

        $results =  $this->_cleanIndex($this->db->executeStmt($this->stmt)->fetchAll());

        return ($this->single && !empty($results)) ? $results[0] : $results;
    }

    public function selectById($id, array $attributes = array())
    {
        return $this->single()->where(array($this->table . '_id' => $id))->select($attributes);
    }

    public function updateById($id, array $attributes = array())
    {
        $this->sql = 'UPDATE ' . $this->table . ' SET ';

        foreach ($attributes as $key => $value) {
            if (!is_int($key)) {
                $this->sql .= $key . ' = ' . ':' . $key . ', ';
            }
        }

        $this->sql .= 'WHERE ' . $this->table . '_id = :id;';

        $this->sql = str_replace(', WHERE', ' WHERE', $this->sql);

        $this->stmt = $this->db->prepare($this->sql);

        foreach ($attributes as $key => $value) {
            if (!is_int($key)) {
                $this->stmt->bindValue(':' . $key, $value);
            }
        }

        $this->stmt->bindValue('id', $id, PDO::PARAM_INT);

        return $this->db->executeStmt($this->stmt);
    }

    public function insert(array $values = array())
    {
        $this->sql = 'INSERT INTO ' . $this->table . ' (' . implode(', ', array_keys($values)) . ')  VALUES (';

        $valuesToBind = array();
        foreach ($values as $key => $value) {
            $valuesToBind[] = ':' . $key;
        }

        $this->sql .= implode(', ', $valuesToBind) .' );';

        $this->stmt = $this->db->prepare($this->sql);

        foreach ($values as $key => $value) {
            if (is_int($value)) {
                $this->stmt->bindValue($key, $value, PDO::PARAM_INT);
            } else {
                $this->stmt->bindValue($key, $value);
            }
        }

        $this->db->executeStmt($this->stmt);

        return $this->db->lastInsertId();
    }

    public function delete(array $values = array())
    {

    }

    public function where(array $params = array())
    {
        $this->where = $params;

        return $this;
    }

    public function single($value = true)
    {
        $this->single = $value;

        return $this;
    }

    public function join(array $values = array())
    {
        $this->join = $values;

        return $this;
    }

    public function orderBy(array $values = array())
    {
        $this->orderBy = $values;

        return $this;
    }

    public function limit(array $values = array())
    {
        $this->limit = $values;

        return $this;
    }
}