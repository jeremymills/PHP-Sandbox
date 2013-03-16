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
use PhpSandbox\Compiler\Exception as CompilerException;
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
    
    private $input = null;
    
    /**
     * Creates a new Compiler instance.
     *
     * @access public
     */
    public function __construct()
    {
        
    }
    
    /**
     *
     * @access public
     */
    public function run()
    {
        set_error_handler(array($this, 'error'));
        set_exception_handler(array($this, 'exception'));
        
        try {
            
            // $tokenizer = new Tokenizer($this->input);
            
            
        } catch (\Exception $exception) {
            
        }
        
        restore_exception_handler();
        restore_error_handler();
    }
    
    /**
     *
     *
     */
    public function exception(Exception $exception)
    {
        
    }
    
    /**
     *
     *
     */
    public function error($errno, $errmsg, $errfile, $errline, array $context = array())
    {
        
    }
    
    /**
     *
     *
     */
    final public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
        $this->has_logger = null !== $this->logger;
    }
    
    /**
     *
     *
     */
    final protected function getLogger()
    {
        return $this->logger;
    }
    
    /**
     * 
     * 
     * @access public
     * @return bool Returns a boolean s
     */
    final protected function hasLogger()
    {
        return $this->has_logger;
    }
}
