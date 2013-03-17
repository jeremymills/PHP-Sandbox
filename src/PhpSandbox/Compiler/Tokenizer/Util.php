<?php
/**
 * PHP Sandbox
 *
 * @link https://github.com/amcgowanca/php-sandbox
 * @copyright Copyright (c) 2013 McGowan Corp. (http://www.mcgowancorp.com)
 * @license https://github.com/amcgowanca/PHP-Sandbox/blob/master/LICENSE.txt
 */

namespace PhpSandbox\Compiler\Tokenizer;

use PhpSandbox\Compiler\Tokenizer\Token\Token;

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
     * @access public
     * @param
     * @return
     */
    public static function resolveSimpleToken($token)
    {
        // TODO: Complete implementation & docblock
    }
    
    /**
     * Resolves T_STRING tokens.
     *
     * @access public
     * @param mixed $token The raw T_STRING token to process.
     * @return array Returns an array of token info if valid, otherwise null.
     */
    public static function resolveTStringToken($token)
    {
        $t = null;
        switch ($token) {
            case 'false':
              $t = array(0 => Token::T_FALSE, 1 => 'false');
              break;
            
            case 'true':
              $t = array(0 => Token::T_TRUE, 1 => 'true');
              break;
            
            case 'null':
              $t = array(0 => Token::T_NULL, 1 => 'null');
              break;
            
            case 'self':
              $t = array(0 => Token::T_SELF, 1 => 'self');
              break;
              
            case 'parent':
              $t = array(0 => Token::T_PARENT, 1 => 'parent');
              break;
              
            default:
              $t = array(0 => Token::T_STRING, 1 => $token);
              break;
        }
        
        return $t;
    }
    
    /**
     * @ignore
     */
    final private function __construct()
    {
    }
}
