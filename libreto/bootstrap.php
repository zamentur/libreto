<?php

if(!defined('LIBRETO')) define('LIBRETO', true);
if(!defined('DS'))    define('DS', DIRECTORY_SEPARATOR);

// load all dependencies
require __DIR__ . DS . 'vendor' . DS . 'autoload.php';

// load all core classes
spl_autoload_register('loadClass');

// load all helper functions
require __DIR__ . DS . 'helpers.php';
