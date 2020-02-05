<?php

/**
 * Autoload classes
 */
function autoload($class_name) {
    // array folders when will find classes
    $array_paths = array(
        '/models/',
        '/components/',
        '/controllers/',
    );

    //forming path and class name
    foreach ($array_paths as $path) {

        $path = ROOT . $path . $class_name . '.php';

        if (is_file($path)) {
            include_once $path;
        }
    }
}

spl_autoload_register('autoload');

