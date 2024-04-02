<?php

function autoloader($class_name)
{
    $array_paths = array(
        '/models/',
        '/components/',
        '/controllers/'
    );

    foreach ($array_paths as $path) {
        $path = ROOT . $path . str_replace('\\', '/', $class_name) . '.php';
//        echo 'Debug: Trying ' . $path . '<br>';
        if (is_file($path)) {
//            echo 'Debug: Class ' . $class_name . ' found at ' . $path . '<br>';
            include_once $path;
            return;
        }
    }
}


spl_autoload_register('autoloader');
