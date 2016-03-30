<?php

class Model_Manager
{
    private static $_instance = null;

    private $_models = array();

    protected $db;
    protected $context;

    public function __construct(Db $db)
    {
        $this->db      = $db;
        $this->context = Context::getInstance();
    }

    public static function getInstance()
    {
        if (empty(self::$_instance)) {
            $db = new Db();
            $context = Context::getInstance();

            self::$_instance = new self($db, $context);
        }

        return self::$_instance;
    }

    public function getConn()
    {
        return $this->db;
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
}
