<?php

Abstract Class Service extends Model
{
    protected $_dependencies = array();

    public $name;
    public $model;
    public $context;
    public $query;

    public function __construct()
    {
        $this->context = Context::getInstance();
        $this->model   = Model_Manager::getInstance();
    }

    public function query($table)
    {
        if (empty($this->query)) {
            $this->query = new QueryBuilder($table);

            return $this->query;
        } else {
            return $this->query->table($table);
        }
    }

    public function get($service)
    {
        return $this->_dependencies[strtolower($service)];
    }

    public function getName()
    {
        if (empty($this->name)) {
            $this->name = strtolower(str_replace('Service', '', get_called_class()));
        }

        return $this->name;
    }

    public function requires(Service $dependenceService)
    {
        $this->_dependencies[$dependenceService->getName()] = $dependenceService;

        return $this;
    }
}
