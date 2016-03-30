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

}
