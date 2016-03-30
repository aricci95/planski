<?php

class Model_Manager extends Model
{

    private static $_instance = null;

    private $_models = array();

    public static function getInstance()
    {
        if (empty(self::$_instance)) {
            $db = new Db();
            $context = Context::getInstance();

            self::$_instance = new self($db, $context);
        }

        return self::$_instance;
    }

    public function __get($model)
    {
        $lowerName = strtolower($model);

        if (!isset($this->_models[$lowerName])) {
            $this->_models[$lowerName] = $this->load($lowerName);
        }

        return $this->_models[$lowerName];
    }

    public function load($model)
    {
        $model     = ucfirst($model);
        $lowerName = strtolower($model);
        $filePath  = ROOT_DIR . '/appli/models/' . $model . '.php';

        if (!file_exists($filePath)) {
            throw new Exception('Model "'. $model .'" introuvable.', ERROR_NOT_FOUND);
        }

        require_once $filePath;

        $this->_models[$model] = new $model($this->db);

        return $this->_models[$model];
    }

    public function find($table, array $attributes = array(), array $where = array(), array $orderBy = array(), $limit = null)
    {
        $attributes_string = empty($attributes) ? '*' : implode(',', $attributes);

        return $this->_selectBuilder($table, $attributes_string, $where, $orderBy, $limit);
    }

    public function findOne($table, array $attributes = array(), array $where = array(), array $orderBy = array(), $limit = null)
    {
        $fetch = $this->find($table, $attributes, $where, $orderBy);

        return empty($fetch) ? null : $fetch[0];
    }

    public function updateById($table, $attributes, $id)
    {
        return $this->_updateBuilder($table, $attributes, $id);
    }
}
