<?php
/**
 * PHP Sandbox
 *
 * @link https://github.com/amcgowanca/php-sandbox
 * @copyright Copyright (c) 2013 McGowan Corp. (http://www.mcgowancorp.com)
 * @license https://github.com/amcgowanca/PHP-Sandbox/blob/master/LICENSE.txt
 */

namespace PhpSandbox\Compiler\Tokenizer;

/**
 * Utility class of static helper methods for tokenization.
 * 
 * @author Aaron McGowan <aaron.mcgowan@mcgowancorp.com>
 * @package PhpSandbox.Compiler.Tokenizer
 * @version 0.0.1
 */
class Util
{
    /**
     *
     * @return array
     */
    public static function resolveTStringToken($token)
    {
        switch ($token) {
            case 'false':
            case 'true':
            case 'null':
            case 'self':
            case 'parent':
              
            default:
              break;
        }
    }
    
    /**
     * @ignore
     */
    final private function __construct()
    {
    }
}
