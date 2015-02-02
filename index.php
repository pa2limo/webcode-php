<?php

/**
 * A simple PHP MVC skeleton 
 *
 * @package php-mvc
 * @author Pa2limo
 * @link http://www.php-mvc.net
 * @link https://github.com/pa2limo/webcode-php
 * @license http://opensource.org/licenses/MIT MIT License
 */

// load the (optional) Composer auto-loader
if (file_exists('vendor/autoload.php')) {
    require 'vendor/autoload.php';
}

// load application config (error reporting etc.)
require 'application/config/config.php';

// load application class
require 'application/libs/application.php';
require 'application/libs/controller.php';
require 'application/libs/mylib.php';
// start the application
$app = new Application();
