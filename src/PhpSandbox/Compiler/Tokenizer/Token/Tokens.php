<?php
/**
 * PHP Sandbox
 *
 * @link https://github.com/amcgowanca/php-sandbox
 * @copyright Copyright (c) 2013 McGowan Corp. (http://www.mcgowancorp.com)
 * @license https://github.com/amcgowanca/PHP-Sandbox/blob/master/LICENSE.txt
 */

namespace PhpSandbox\Compiler\Tokenizer\Token;

use PhpSandbox\Compiler\Tokenizer\Token\Token;

/**
 * A collection used for representing a set of Token instances.
 *
 * @author Aaron McGowan <aaron.mcgowan@mcgowancorp.com>
 * @package PhpSandbox.Compiler.Tokenizer.Token
 * @version 0.0.1
 */
class Tokens implements \Countable, \ArrayAccess
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
     * @var string The string representation of the tokens.
     */
    private $as_string = '';
    
    /**
     * Creates a new instance of Tokens.
     *
     * @access public
     */
    public function __construct()
    {
    }
    
    /**
     * Returns the number of tokens within this list.
     *
     * @access public
     * @return int Returns the total count.
     */
    public function getCount()
    {
        return $this->count;
    }
    
    /**
     * Returns the first token within the list.
     *
     * @access public
     * @return Token Returns the first token if the list is not empty, otherwise null.
     */
    public function getFirst()
    {
        if ($this->isEmpty()) {
            return null;
        }
        
        return $this->tokens[0];
    }
    
    /**
     * Returns the last token within the list.
     *
     * @access public
     * @return Token Returns the last token if the list not empty, otherwise null.
     */
    public function getLast()
    {
        if ($this->isEmpty()) {
            return null;
        }
        
        return $this->tokens[$this->count - 1];
    }
    
    /**
     * Returns the number of tokens.
     *
     * @access public
     * @return int Returns the number of tokens within.
     */
    public function count()
    {
        return $this->getCount();
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
     * Adds a new token onto the end of the list.
     *
     * Alias of push().
     *
     * @access public
     * @param Token $token The token to add to the list.
     */
    public function add(Token $token)
    {
        return $this->push($token);
    }
    
    /**
     * Returns if boolean to indicate whether or not the specified index exists.
     *
     * @access public
     * @param int $index The index of the token to test whether it exists.
     * @return bool Returns true if the index exists, otherwise false.
     */
    public function containsKey($index)
    {
        return isset($this->tokens[$index]);
    }
    
    /**
     * Adds a new token onto the end of the list.
     *
     * @access public
     * @param Token $token The token instance to add to the list.
     */
    public function push(Token $token)
    {
        $this->tokens[] = $token;
        $this->count++;
        $this->as_string = null;
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
        $this->as_string = null;
        
        return $token;
    }
    
    /**
     * Removes a token at the specified index.
     *
     * @access public
     * @param int $index The index of the token to remove.
     * @return bool Returns true if the token has been successfully removed, otherwise false.
     */
    public function removeAt($index)
    {
        if (isset($this->tokens[$index]))
        {
            unset($this->tokens[$index]);
            $this->count--;
            $this->as_string = null;
            return true;
        }
        
        return false;
    }
    
    /**
     * Returns a string representation of all tokens.
     *
     * @access public
     * @return string
     */
    final public function __toString()
    {
        return $this->toString();
    }
    
    /**
     * Returns a string representation of all tokens.
     *
     * @access public
     * @return string
     */
    public function toString()
    {
        if (null === $this->as_string) {
            foreach ($this->tokens as $k => &$token) {
                $this->as_string .= $token->toString();
            }
        }
        
        return $this->as_string;
    }
    
    public function offsetGet($index)
    {
        return $this->get($index);
    }
    
    public function offsetSet($index, $token)
    {
        if (!($token instanceof Token)) {
            throw new Exception('Values must be of type Token.');
        }
        
        if (!isset($this->tokens[$index])) {
            $this->count++;
        }
        
        $this->tokens[$index] = $token;
        $this->as_string = null;
    }
    
    public function offsetExists($index)
    {
        return $this->containsKey($index);
    }
    
    public function offsetUnset($index)
    {
        return $this->removeAt($index);
    }
}
