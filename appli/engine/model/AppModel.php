<?php

abstract class AppModel extends Model
{

    public $table;
    public $primary;

    public function getTable()
    {
         if (empty($this->table)) {
            $this->table = strtolower(get_called_class());
        }

        return $this->table;
    }

    public function getPrimary()
    {
        if (empty($this->primary)) {
            $this->primary = $this->getTable() . '_id';
        }

        return $this->primary;
    }

    public function count(array $where = array(), array $orderBy = array(), $limit = null)
    {
        $attributes_string = 'count(*) AS counter';

        $data = $this->_selectBuilder($this->getTable(), $attributes_string, $where, $orderBy, $limit);

        return (int) $data[0]['counter'];
    }

    public function find(array $attributes = array(), array $where = array(), array $orderBy = array(), $limit = null)
    {
        $attributes_string = empty($attributes) ? '*' : implode(',', $attributes);

        return $this->_selectBuilder($this->getTable(), $attributes_string, $where, $orderBy, $limit);
    }

    public function findOne(array $attributes = array(), array $where = array(), array $orderBy = array(), $limit = null)
    {
        $fetch = $this->find($attributes, $where, $orderBy);

        return empty($fetch) ? null : $fetch[0];
    }

    public function findById($id, array $attributes = array(), array $orderBy = array(), $limit = null)
    {
        $attributes_string = empty($attributes) ? '*' : implode(',', $attributes);

        $where = array(
            $this->getPrimary() => (int) $id,
        );

        $results = $this->_selectBuilder($this->getTable(), $attributes_string, $where, $orderBy, $limit);

        return empty($results[0]) ? array() : $results[0];
    }

    public function updateById($attributes, $id)
    {
        return $this->_updateBuilder($this->getTable(), $attributes, $id);
    }

    public function insert(array $values)
    {
        $sql = 'INSERT INTO ' . $this->getTable() . ' (' . implode(', ', array_keys($values)) . ')  VALUES (';

        $valuesToBind = array();
        foreach ($values as $key => $value) {
            $valuesToBind[] = ':' . $key;
        }

        $sql .= implode(', ', $valuesToBind) .' );';

        $stmt = $this->db->prepare($sql);

        foreach ($values as $key => $value) {
            if (is_int($value)) {
                $stmt->bindValue($key, $value, PDO::PARAM_INT);
            } else {
                $stmt->bindValue($key, $value);
            }
        }

        $this->db->executeStmt($stmt);

        return $this->db->lastInsertId();
    }

}
