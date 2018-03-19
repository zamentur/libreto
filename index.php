<?php
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', __DIR__);

// load all dependencies
require __DIR__ . DS . 'libreto' . DS . 'vendor' . DS . 'load.php';

// load all helpers functions
require __DIR__ . DS . 'libreto' . DS . 'helpers.php';

// load all core classes
function loadClass($classe) {
  require __DIR__ . DS . 'libreto' . DS . strtolower($classe) . '.php';
}
spl_autoload_register('loadClass');

// load options
require __DIR__ . DS . 'config.php';

// create Libreto
$libreto = new Libreto($options);

// launch
$libreto->launch();

// var_dump($libreto);
