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
        if(Tools::status($userLastConnexion) == 'online.gif') {
            echo  '<img src="planski/images/icones/online.gif" title="online" />';
        } else {
            echo '<img src="planski/images/icones/offline.png" title="offline" />';
        }

        if($full) echo '</span>';
    }

    public function formFooter($previousUrl, $submit = true)
    {
        echo '<div align="center" style="clear:both;">';

        if($submit) {
            echo '<input type="image" src="MLink/images/boutons/valider.png" value="Valider" style="border:0px;" border="0" />';
        }

        echo '<a href="'.$previousUrl.'" /><img src="MLink/images/boutons/retour.png" /></a>';
        echo '</div>';
    }
}


