<?php

class ViewHelper {

    public $now = 0;
    public $context;
    private $_helper;

    public function __construct()
    {
        $this->context = Context::getInstance();
        $this->_helper = $this;
    }

    public function render($view)
    {
        $view = trim($view);
        $view = str_replace("../","protect", $view);
        $view = str_replace(";","protect", $view);
        $view = str_replace("%","protect", $view);

        $viewPath = ROOT_DIR . '/appli/views/' . $view . '.php';

        if (file_exists($viewPath)) {
            include $viewPath;
        }
    }

    public function showStatut($userLastConnexion, $full = false)
    {
        if($this->status($userLastConnexion) == 'online.gif') {
            echo  '<img src="planski/images/icone/online.gif" title="online" />';
        } else {
            echo '<img src="planski/images/icone/offline.png" title="offline" />';
        }

        if($full) echo '</span>';
    }
}


