<?php
/**
 * PHP Sandbox
 *
 * @link https://github.com/amcgowanca/php-sandbox
 * @copyright Copyright (c) 2013 McGowan Corp. (http://www.mcgowancorp.com)
 * @license https://github.com/amcgowanca/PHP-Sandbox/blob/master/LICENSE.txt
 */

namespace PhpSandbox\Compiler\Symbols;

use PhpSandbox\Exception;
use PhpSandbox\Compiler\Symbols\Symbol;

/**
 * Represents a symbol table of symbols.
 * 
 * @author Aaron McGowan <aaron.mcgowan@mcgowancorp.com>
 * @package PhpSandbox.Compiler
 * @version 0.0.1
 */
class SymbolTable implements \ArrayAccess, \Countable
{
    /**
     * @var array An associative array of symbols.
     */
    private $symbols = array();
    
    /**
     * @var int The total count of symbols.
     */
    private $symbols_count = 0;
    
    /**
     * Creates a new instance of a SymbolTable.
     *
     * @access public
     */
    public function __construct()
    {
    }
    
    /**
     *
     * @access public
     * @param Symbol $symbol A symbol to add or set its value.
     * @return SymbolTable Returns this instance of the symbol table.
     */
    public function set(Symbol $symbol)
    {
        if (!isset($this->symbols[$symbol->getName()])) {
            $this->symbols_count++;
        }
        
        $this->symbols[$symbol->getName()] = $symbol;
        return $this;
    }
    
    /**
     *
     * @access public
     * @param string $symbol
     * @return mixed Returns the Symbol object if the symbol exists, otherwise returns null.
     */
    public function get($symbol)
    {
        return isset($this->symbols[$symbol]) ? $this->symbols[$symbol] : null;
    }
    
    /**
     *
     *
     */
    public function exists($symbol)
    {
        return isset($this->symbols[$symbol]);
    }
    
    /**
     *
     */
    public function remove($symbol)
    {
        if (isset($this->symbols[$symbol])) {
            unset($this->symbols[$symbol]);
            $this->symbols_count--;
            return true;
        }
        
        return false;
    }
    
    /**
     * Returns the number of symbols in this table.
     *
     * @access public
     * @return int Returns the count of symbols.
     */
    public function count()
    {
        return $this->symbols_count;
    }
    
    /**
     *
     */
    public function offsetGet($symbol)
    {
        return $this->get($symbol);
    }
    
    /**
     *
     */
    public function offsetSet($index, $symbol)
    {
        if (!($symbol instanceof Symbol)) {
            throw new Exception(sprintf('SymbolTable expects that the value assigned using array notation is of type \PhpSandbox\Compiler\Symbol.'));
        }
        
        if ($index !== $symbol->getName()) {
            throw new Exception(sprintf('SymbolTable expects that index used to access or mutate a symbol is the same as the symbol name.'));
        }
        
        return $this->set($symbol);
    }
    
    /**
     *
     */
    public function offsetExists($symbol)
    {
        return $this->exists($symbol);
    }
    
    /**
     *
     */
    public function offsetUnset($symbol)
    {
        return $this->remove($symbol);
    }
}
