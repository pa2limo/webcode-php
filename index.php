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

// load the (optional) Composer auto-loader
if (file_exists('vendor/autoload.php')) {
    require 'vendor/autoload.php';
}

// load application config (error reporting etc.)
require 'application/config/config.php';

// load application class
require 'application/boot/appurl.php';
require 'application/boot/controller.php';
require 'application/addlibs/mylib.php';
// start the application
$app = new Appurl();
