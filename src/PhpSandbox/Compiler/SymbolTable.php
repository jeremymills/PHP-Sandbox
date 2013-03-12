<?php
/**
 * PHP Sandbox
 *
 * @link https://github.com/amcgowanca/php-sandbox
 * @copyright Copyright (c) 2013 McGowan Corp. (http://www.mcgowancorp.com)
 * @license https://github.com/amcgowanca/PHP-Sandbox/blob/master/LICENSE.txt
 */

namespace PhpSandbox\Compiler;

use PhpSandbox\Exception;
use PhpSandbox\Compiler\Symbol;

/**
 * 
 * 
 * @author Aaron McGowan <aaron.mcgowan@mcgowancorp.com>
 * @package PhpSandbox.Compiler
 * @version 0.0.1
 */
class SymbolTable implements \ArrayAccess, \Countable
{
    /**
     * @var
     */
    private $symbols = array();
    
    /**
     * @var int The total count of symbols.
     */
    private $symbols_count = 0;
    
    public function __construct()
    {
    }
    
    public function set(Symbol $symbol)
    {
        if (!isset($this->symbols[$symbol->getName()])) {
            $this->symbols_count++;
        }
        
        $this->symbols[$symbol->getName()] = $symbol;
    }
    
    public function get($symbol)
    {
        return isset($this->symbols[$symbol]) ? $this->symbols[$symbol] : null;
    }
    
    public function exists($symbol)
    {
        return isset($this->symbols[$symbol]);
    }
    
    public function remove($symbol)
    {
        if (isset($this->symbols[$symbol])) {
            unset($this->symbols[$symbol]);
            $this->symbols_count--;
            return true;
        }
        
        return false;
    }
    
    public function count()
    {
        return $this->symbols_count;
    }
    
    public function offsetGet($symbol)
    {
        return $this->get($symbol);
    }
    
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
    
    public function offsetExists($symbol)
    {
        return $this->exists($symbol);
    }
    
    public function offsetUnset($symbol)
    {
        return $this->remove($symbol);
    }
}
