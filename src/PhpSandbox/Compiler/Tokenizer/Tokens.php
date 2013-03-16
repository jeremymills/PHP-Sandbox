<?php
/**
 * PHP Sandbox
 *
 * @link https://github.com/amcgowanca/php-sandbox
 * @copyright Copyright (c) 2013 McGowan Corp. (http://www.mcgowancorp.com)
 * @license https://github.com/amcgowanca/PHP-Sandbox/blob/master/LICENSE.txt
 */

namespace PhpSandbox\Compiler\Tokenizer;

use PhpSandbox\Compiler\Tokenizer\Token;

/**
 * A collection used for representing a set of Token instances.
 *
 * @author Aaron McGowan <aaron.mcgowan@mcgowancorp.com>
 * @package PhpSandbox.Compiler.Tokenizer
 * @version 0.0.1
 */
class Tokens implements \Countable
{
    /**
     * @var array The internal storage of token instances.
     */
    private $tokens = array();
    
    /**
     * @var int The number of tokens within the collection.
     */
    private $count = 0;
    
    /**
     * Creates a new instance of Tokens.
     *
     * @access public
     */
    public function __construct()
    {
    }
}
