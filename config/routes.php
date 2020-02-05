<?php

return array(
    // User
    'login' => 'user/login',
    'register' => 'user/register',
    'logout' => 'user/logout',
    //Site
    'delete/([0-9]+)' => 'site/delete/$1',
    'favorite' => 'site/favorite',
    'save/([0-9]+)' => 'site/save/$1', // actionSave в SiteController
    'page-([0-9]+)' => 'site/index/$1', // actionIndex in SiteController   
    'index.php' => 'site/index', // actionIndex в SiteController
    '' => 'site/index', // actionIndex в SiteController
);
