<?php

/**
 * A simple PHP MVC skeleton 
 *
 * @package php-mvc
 * @author pa2limo
 * @link http://www.webcode.or.id
 * @link https://github.com/pa2limo/webcode-php
 * @license http://opensource.org/licenses/MIT MIT License
 */

// load the Composer auto-loader (optional)
if (file_exists('vendor/autoload.php')) {
    require 'vendor/autoload.php';
}

// load application config
require 'application/config.php';

// load application class
require 'application/appurl.php';
require 'application/controller.php';
require 'application/mylib.php';
// start the application
$app = new Appurl(); // start app engines (igniter)
