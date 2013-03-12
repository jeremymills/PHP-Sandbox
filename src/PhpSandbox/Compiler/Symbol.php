<?php
/**
 * PHP Sandbox
 *
 * @link https://github.com/amcgowanca/php-sandbox
 * @copyright Copyright (c) 2013 McGowan Corp. (http://www.mcgowancorp.com)
 * @license https://github.com/amcgowanca/PHP-Sandbox/blob/master/LICENSE.txt
 */

namespace PhpSandbox\Compiler;

/**
 *
 * @author Aaron McGowan <aaron.mcgowan@mcgowancorp.com>
 * @package PhpSandbox.Compiler
 * @version 1.0.0
 */
class Symbol
{
    const TYPE_VARIABLE = 1;
  
    /**
     * @var int
     */
    private $type;
    
    /**
     * @var string 
     */
    private $name;
    
    /**
     * @var mixed
     */
    private $value = null;
    
    /**
     * Creates a new instance of the symbol class.
     *
     * @access public
     * @param int $type The type of this Symbol.
     */
    public function __construct($type, $name, $value = null)
    {
        $this->setType($type);
        $this->setName($name);
    }
    
    public function getType()
    {
        return $this->type;
    }
    
    public function getName()
    {
        return $this->name;
    }
    
    public function getValue()
    {
        return $this->value;
    }
    
    public function setValue($value)
    {
        $this->value = $value;
    }
    
    protected function setType($type)
    {
        $this->type = $type;
    }
    
    protected function setName($name)
    {
        $this->name = $name;
    }
}
