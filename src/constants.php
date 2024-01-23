<?php
/**
 * Project slim-3-skeleton.
 * Created by PhpStorm.
 * User: 713uk13m <dev@nguyenanhung.com>
 * Date: 10/29/18
 * Time: 15:45
 */
/*
 *---------------------------------------------------------------
 * APPLICATION ENVIRONMENT
 *---------------------------------------------------------------
 *
 * You can load different configurations depending on your
 * current environment. Setting the environment also influences
 * things like logging and error reporting.
 *
 * This can be set to anything, but default usage is:
 *
 *     development
 *     testing
 *     production
 *
 * NOTE: If you change these, also change the error_reporting() code below
 */
defined('ENVIRONMENT') or define('ENVIRONMENT', 'production');
defined('VERSION') or define('VERSION', '3.11.3');

// Project Path
defined('PROJECT_PATH') or define('PROJECT_PATH', __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR);

// Directory mapping
defined('VENDOR_PATH') or define('VENDOR_PATH', __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR);
defined('TEMPLATE_PATH') or define('TEMPLATE_PATH', __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR);
defined('PUBLIC_PATH') or define('PUBLIC_PATH', __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR);

// Source Path
defined('SOURCE_PATH') or define('SOURCE_PATH', __DIR__ . DIRECTORY_SEPARATOR);
defined('APP_PATH') or define('APP_PATH', SOURCE_PATH . 'App' . DIRECTORY_SEPARATOR);
defined('COMMANDS_PATH') or define('COMMANDS_PATH', SOURCE_PATH . 'Commands' . DIRECTORY_SEPARATOR);
defined('HELPER_PATH') or define('HELPER_PATH', SOURCE_PATH . 'Helper' . DIRECTORY_SEPARATOR);
defined('LIBRARY_PATH') or define('LIBRARY_PATH', SOURCE_PATH . 'Library' . DIRECTORY_SEPARATOR);

// Storage Path
defined('STORAGE_PATH') or define('STORAGE_PATH', __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR);
defined('CACHE_PATH') or define('CACHE_PATH', STORAGE_PATH . 'cache' . DIRECTORY_SEPARATOR);
defined('LOGS_PATH') or define('LOGS_PATH', STORAGE_PATH . 'logs' . DIRECTORY_SEPARATOR);

/*
 *---------------------------------------------------------------
 * ERROR REPORTING
 *---------------------------------------------------------------
 *
 * Different environments will require different levels of error reporting.
 * By default development will show errors but testing and live will hide them.
 */
switch (ENVIRONMENT) {
    case 'development':
        error_reporting(-1);
        ini_set('display_errors', 1);
        break;

    case 'testing':
    case 'production':
        ini_set('display_errors', 0);
        if (version_compare(PHP_VERSION, '5.3', '>=')) {
            error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);
        } else {
            error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_USER_NOTICE);
        }
        break;

    default:
        header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
        echo 'The application environment is not set correctly.';
        exit(1); // EXIT_ERROR
}

/**
 * Exit Status Codes
 *
 * @see http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
 * @see http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
 * @see http://tldp.org/LDP/abs/html/exitcodes.html
 */
defined('EXIT_SUCCESS') or define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR') or define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG') or define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE') or define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS') or define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') or define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT') or define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE') or define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN') or define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX') or define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code
