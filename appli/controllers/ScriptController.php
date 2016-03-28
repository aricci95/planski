<?php

class ScriptController extends AppController
{

    protected $_authLevel = AUTH_LEVEL_SUPERADMIN;

    public function render()
    {
        $methods = get_class_methods($this);
        $scripts = array();

        foreach ($methods as $method) {
            if (strstr($method, 'renderScript') != false) {
                $scripts[] = str_replace('render', '', $method);
            }
        }

        $this->view->scripts = $scripts;
        $this->view->setViewName('admin/wScript');
        $this->view->setTitle('Scripts');
        $this->view->render();
    }
}
