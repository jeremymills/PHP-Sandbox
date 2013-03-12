<?php
/**
 * PHP Sandbox
 *
 * @link https://github.com/amcgowanca/php-sandbox
 * @copyright Copyright (c) 2013 McGowan Corp. (http://www.mcgowancorp.com)
 * @license https://github.com/amcgowanca/PHP-Sandbox/blob/master/LICENSE.txt
 */

namespace PhpSandbox\Compiler;

use PhpSandbox\Compiler\SymbolTable;
use Psr\Log\LoggerInterface;
use Psr\Log\LoggerAwareInterface;

/**
 *
 * @author Aaron McGowan <aaron.mcgowan@mcgowancorp.com>
 * @package PhpSandbox.Compiler
 * @version 0.0.1
 */
class Compiler implements LoggerAwareInterface
{
    /**
     * @var \Psr\LoggerInterface A PSR compliant logger interface.
     */
    private $logger = null;
    
    /**
     * @var bool A boolean used to indicate if a logger exists.
     */
    private $has_logger = false;
    
    /**
     * @var SymbolTable The compiler's symbol table instance.
     */
    private $symbol_table = null;
    
    /**
     * Creates a new Compiler instance.
     *
     * @access public
     */
    public function __construct()
    {
        
    }
    
    public function run()
    {
        // When the parser is created, ensure that the Symbol table is passed.
    }
    
    final public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
        $this->has_logger = null !== $this->logger;
    }
    
    final protected function getLogger()
    {
        return $this->logger;
    }
    
    final protected function hasLogger()
    {
        return $this->has_logger;
    }
}
