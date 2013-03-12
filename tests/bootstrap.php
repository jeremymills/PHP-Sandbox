<?php
/**
 * PHP Sandbox
 *
 * @link https://github.com/amcgowanca/php-sandbox
 * @copyright Copyright (c) 2013 McGowan Corp. (http://www.mcgowancorp.com)
 * @license https://github.com/amcgowanca/PHP-Sandbox/blob/master/LICENSE.txt
 *
 * @author Aaron McGowan <aaron.mcgowan@mcgowancorp.com>
 */

define('PHPSANDBOX_LIBRARY_ROOT', realpath(__DIR__ . '/../') . '/');

// Initialize autoloader and add PhpSandbox to available lookup paths
$autoloader = require_once PHPSANDBOX_LIBRARY_ROOT . 'vendor/autoload.php';
$autoloader->add('PhpSandbox', PHPSANDBOX_LIBRARY_ROOT . 'src/');
