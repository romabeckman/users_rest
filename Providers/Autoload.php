<?php

defined('BASEPATH') or exit('No direct script access allowed');

spl_autoload_register(function($class) {
    $file = BASEPATH . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';

    if (file_exists($file))
        include_once $file;
});

