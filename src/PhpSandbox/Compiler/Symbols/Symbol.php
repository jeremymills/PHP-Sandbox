<?php
/**
 * PHP Sandbox
 *
 * @link https://github.com/amcgowanca/php-sandbox
 * @copyright Copyright (c) 2013 McGowan Corp. (http://www.mcgowancorp.com)
 * @license https://github.com/amcgowanca/PHP-Sandbox/blob/master/LICENSE.txt
 */

namespace PhpSandbox\Compiler\Symbols;

/**
 *
 * @author Aaron McGowan <aaron.mcgowan@mcgowancorp.com>
 * @package PhpSandbox.Compiler.Symbol
 * @version 1.0.0
 */
abstract class Symbol
{
    /**
     * @var string 
     */
    private $name;
    
    /**
     * Creates a new instance of the symbol class.
     *
     * @access public
     * @param int $type The type of this Symbol.
     * @param string $name The name of the Symbol.
     */
    public function __construct($name)
    {
        $this->setName($name);
    }
    
    /**
     * Returns the name of this symbol.
     *
     * @access public
     * @return string Returns the symbol name.
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * Sets the name of this symbol.
     *
     * @access public
     * @param string $name The name of the symbol.
     */
    final protected function setName($name)
    {
        $this->name = $name;
    }
}
