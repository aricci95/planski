<?php

class AppView
{

    private $_name;
    private $_title;

    protected $_html;
    protected $_JSLibraries     = array();
    protected $_growlerMessages = true;

    public $context;
    public $container;


    public function __construct(Service_Container $container, Context $context)
    {
        $this->container = $container;
        $this->context = $context;
        $this->_helper = new ViewHelper();

        $date  = date('m');
        $this->headerImg = 'planski/images/structure/';
        $this->headerImg .= 'newheader.png';
    }

    public function setHelperDatas(array $datas)
    {
        foreach ($datas as $key => $data) {
            $this->_helper->$key = $data;
        }
    }

    public function setViewName($name = '')
    {
        $this->_name = $name;
    }

    public function getViewName()
    {
        return $this->_name;
    }

    public function setTitle($title = '')
    {
        $this->_title = $title;
    }

    public function getPage()
    {
        return !empty($_GET['page']) ? $_GET['page'] : 'user';
    }

    public function getViewFileName()
    {
        return 'views/' . $this->_name . '.php';
    }

    public function getTitle()
    {
        return strtoupper($this->_title);
    }

    public function setViewDatas($datas = array())
    {
        foreach ($datas as $key => $val) {
            echo $key;
            $this->$key = $val;
        }
    }

    public function addJS($library)
    {
        $this->_JSLibraries[$library] = true;
    }

    public function isJSActivated($library)
    {
        if (array_key_exists($library, $this->_JSLibraries) && $this->_JSLibraries[$library]) {
            return true;
        } else {
            return false;
        }
    }

    public function render($view = null, $datas = array())
    {
        if ($this->_growlerMessages == true) {
            $this->_growlerMessages = $this->container->get('growler')->getMessages();
        }

        if (count($datas) > 0) {
            foreach ($datas as $key => $data) {
                $this->$key = $data;
            }
        }

        echo trim($this->runView($view));
    }

    public function runView($view = null)
    {
        ob_start();

        if (empty($view)) {
            include('views/main/view.php');
        } else {
            $view = trim($view);
            $view = str_replace("../","protect", $view);
            $view = str_replace(";","protect", $view);
            $view = str_replace("%","protect", $view);

            $viewPath = trim('views/' . $view . '.php');

            if (file_exists($viewPath) && $viewPath != 'index.php') {
               include $viewPath;
            }
        }

        return ob_get_clean();
    }

    public function getJSONResponse($view)
    {
        echo trim($this->runView($view));
    }
}
