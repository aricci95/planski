<?php

require_once ROOT_DIR . '/appli/controllers/SearchController.php';

class AppartController extends SearchController
{
    protected $_type = SEARCH_TYPE_APPART;

    protected $_searchParams = array(
        'search_login',
        'search_distance',
        'search_gender',
        'search_age',
    );

}