<?php
session_name('planski');
session_start();

// Récupération du chemin absolu
$removedStrings = array(
    '\appli',
    '/appli',
);

$path =  str_replace($removedStrings, array(), dirname(__FILE__));

define('ROOT_DIR', $path);

// inculusion de la conf et des constantes
require ROOT_DIR . '/config/params.php';
require ROOT_DIR . '/appli/constants.php';

// APPLICATION BOOTSTRAP
// CONTROLLER
if(!empty($_GET['page']) && ucfirst($_GET['page']) != 'Plan') {
    $page = ucfirst($_GET['page']).'Controller';
    if(!file_exists(ROOT_DIR.'/appli/controllers/'.$page.'.php')) {
        $page = 'PlanController';
    }
} else {
    $page = 'PlanController';
}

// ACTION
$action = 'render';
if (!empty($_GET['action']) && ucfirst($_GET['action']) != 'Plan') {
    $action .= ucfirst($_GET['action']);
}


// AutoLoad function
function autoLoader($class_name) {
    require ROOT_DIR . '/appli/models/' . $class_name . '.php';
}

spl_autoload_register('autoLoader');


// Loading application files
require ROOT_DIR . '/engine/Context.php';
require ROOT_DIR . '/engine/Log.php';
require ROOT_DIR . '/engine/view/AppView.php';

// Models
require ROOT_DIR . '/engine/model/Db.php';
require ROOT_DIR . '/engine/model/Model.php';
require ROOT_DIR . '/engine/model/Manager.php';
require ROOT_DIR . '/engine/model/QueryBuilder.php';

// Services
require ROOT_DIR . '/engine/service/Service.php';
require ROOT_DIR . '/engine/service/Container.php';

// Controllers
require ROOT_DIR . '/engine/controller/Controller.php';
require ROOT_DIR . '/engine/controller/AppController.php';

// Classes propres au site
require ROOT_DIR . '/appli/models/User.php';
require ROOT_DIR . '/appli/views/ViewHelper.php';

// gestionnaire d'erreurs
include ROOT_DIR . '/engine/ErrorHandler.php';
set_error_handler("ErrorHandler");

try {
    require_once ROOT_DIR . '/appli/controllers/' . $page . '.php';

    $controller = new $page();
    $controller->$action();
} catch (Exception $e) {
    Service_Container::getInstance()->get('Mailer')->sendError($e);

    if ($page == 'PlanController') {
        include ROOT_DIR . '/appli/views/maintenance.htm';
        die;
    } else {
        require_once ROOT_DIR . '/appli/controllers/PlanController.php';
        $controller = new PlanController();

        $controller->view->growlerError();
        $controller->render();
    }
}

?>
