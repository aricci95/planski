<?php

abstract class Model
{

    protected $db;
    protected $context;

    private $_queryBuilder;

    public function __construct(Db $db)
    {
        $this->db      = $db;
        $this->context = Context::getInstance();
    }

    public function query($table = null)
    {
        if (empty($table)) {
            $table = strtolower(get_class($this));
        }

        if (empty($this->_queryBuilder)) {
            $this->_queryBuilder = new QueryBuilder($this->db, $table);
        } else {
            $this->_queryBuilder->table($table);
        }

        return $this->_queryBuilder;
    }

}
