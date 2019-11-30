<?php

define('BASEPATH', dirname(__FILE__) . DIRECTORY_SEPARATOR);

require_once BASEPATH . 'Core/Autoload.php';

Core\Bootstrap::getInstance()->load();
