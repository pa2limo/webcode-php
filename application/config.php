<?php
/**
 * Configuration
 *
 * For more info about constants please @see http://php.net/manual/en/function.define.php
 * If you want to know why we use "define" instead of "const" @see http://stackoverflow.com/q/2447791/1114320
 */
/**
 * Configuration for: Error reporting
 * Useful to show every little problem during development, but only show hard errors in production
 */
error_reporting(E_ALL);
// ini_set("display_errors", 0); // don't show error
ini_set("display_errors", 1); // show error
/**
 * Configuration for: Project URL
 * Put your URL here, for local development "127.0.0.1" or "localhost" (plus sub-folder) is fine
 *                    for production use "domain name", example "mydomainname.com"
 */
define('URL', 'http://localhost/'); // root
define('ASSET','http://localhost/public/assets/' );
define('IMG','http://localhost/public/asset/img/' );
/**
 * Configuration for: Database
 * This is the place where you define your database credentials, database type etc.
 * Edit your credential below.
 */
define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'yourdbname');
define('DB_USER', 'youruserDB');
define('DB_PASS', 'yourpassword');
