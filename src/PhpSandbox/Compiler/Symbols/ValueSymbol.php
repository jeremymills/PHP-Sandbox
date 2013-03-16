<?php
/**
 * PHP Sandbox
 *
 * @link https://github.com/amcgowanca/php-sandbox
 * @copyright Copyright (c) 2013 McGowan Corp. (http://www.mcgowancorp.com)
 * @license https://github.com/amcgowanca/PHP-Sandbox/blob/master/LICENSE.txt
 */

namespace PhpSandbox\Compiler\Symbols;

use PhpSandbox\Compiler\Symbols\Symbol;

/**
 *
 * @author Aaron McGowan <aaron.mcgowan@mcgowancorp.com>
 * @package PhpSandbox.Compiler.Symbols
 * @version 1.0.0
 */
class ValueSymbol extends Symbol
{
    /**
     * @var mixed The value for this symbol.
     */
    private $value = null;
    
    /**
     * Creates a new instance of the ValueSymbol class.
     *
     * @access public
     * @param string $name The name of the symbol.
     * @param mixed $value The value of the symbol.
     */
    public function __construct($name, $value)
    {
        parent::__construct($name);
        
        $this->setValue($value);
    }
    
    /**
     * Returns the value of the symbol.
     * 
     * @access public
     * @return mixed Returns the symbol value.
     */
    public function getValue()
    {
        return $this->value;
    }
    
    /**
     * Sets the value of the symbol.
     *
     * @access public
     * @param mixed The value of the symbol.
     */
    public function setValue($value)
    {
        $this->value = $value;
    }
}
