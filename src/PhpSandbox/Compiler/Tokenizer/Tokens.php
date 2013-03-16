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
    
    /**s
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
    
    /**
     * Returns the number of tokens.
     *
     * @access public
     * @return int Returns the number of tokens within.
     */
    public function count()
    {
        return $this->count;
    }
    
    /**
     * Returns a boolean to indicate whether the list is empty.
     *
     * @access public
     * @return bool Returns true if the list is empty, otherwise false.
     */
    public function isEmpty()
    {
        return 0 === $this->count();
    }
    
    /**
     *
     *
     * @access public
     * @param Token $token The token instance to add to the list.
     */
    public function push(Token $token)
    {
        $this->tokens[] = $token;
        $this->count++;
    }
    
    /**
     * Pops the last token off the end of the list.
     *
     * @access public
     * @return Token Returns the token that was removed from the end of the list.
     */
    public function pop()
    {
        if ($this->isEmpty()) {
            return;
        }
        
        $token = array_pop($this->tokens);
        $this->count--;
        
        return $token;
    }
    
    final public function __toString()
    {
        return $this->toString();
    }
    
    public function toString()
    {
        // TODO: This needs to be optimized!
        $string = '';
        for ($i = 0; $i < $this->count; ++$i) {
            $string .= $this->tokens[$i]->toString();
        }
        
        return $string;
    }
}
