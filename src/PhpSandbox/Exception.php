<?php
/**
 * PHP Sandbox
 *
 * @link https://github.com/amcgowanca/php-sandbox
 * @copyright Copyright (c) 2013 McGowan Corp. (http://www.mcgowancorp.com)
 * @license https://github.com/amcgowanca/PHP-Sandbox/blob/master/LICENSE.txt
 */

namespace PhpSandbox;

/**
 * A base exception class inherited by all PHP Sandbox specific exceptions.
 *
 * @author Aaron McGowan <aaron.mcgowan@mcgowancorp.com>
 * @package PhpSandbox
 * @version 0.0.1
 */
class Exception extends \Exception
{
    // TODO: Complete
    /**
     * Backtrace for exception
     * 
     * @access private
     */
    private $trace = array();
    
    /**
     * String representation of Exception thrown
     *
     * @access private
     */
    private $string = '';
    
    /**
     * Previous Exception attached if one exists
     *
     * @access private
     */
    private $previous;
        
    /**
     * Constructor for Exception class
     *
     * @access public
     * @param string $message being created
     * @param int $code exception code being defined
     * @param \Exception $previous previous exception if is nested exception
     */
    public function __contruct($message = null, $code = 0, Exception $previous = null)
    {
        if (null !== $message) {
            $this->message = $message;   
        }
        $this->code = $code;
        $this->file = __FILE__;
        $this->line = __LINE__;
        $this->trace = debug_backtrace();
        $this->string = $this->__toString();
        //not sure if we need this as previous is private in parent so we cannot access it
        //but we require a getPrevious function so I assssssssume we will need our own instance
        $this->previous = $previous;
    }
    
    /**
     * Clone function inherited from Exception class to Inhibit cloning
     * 
     */
    final private function __clone()
    {
        //Not sure what to put here ;)
    }
    
    /**
     * Get the Exception message
     *
     * @access public
     * @return string returns the given exception message
     */
    final public function getMessage()
    {
        return $this->message;
    }
    
    /**
     * Get the Exception code
     *
     * @access public
     * @return int returns the exception code
     */
    final public function getCode()
    {
        return $this->code;
    }
    
    /**
     * Get the filename source where the exception occured
     *
     * @access public
     * @return string returns the exceptions source filename
     */
    final public function getFile()
    {
        return $this->file;
    }
    
    /**
     * Get the source line the exception occured
     *
     * @access public
     * @return returns the exceptions source line
     */
    final public function getLine()
    {
        return $this->line;
    }
    
    /**
     * Get the backtrace array for exception
     *
     * @access public
     * @return array returns an array of the backtrace()
     */
    final public function getTrace()
    {
        return $this->trace;
    }
    
    /**
     * Get the previous exception (if exists)
     *
     * @access public
     * @return \Exception returns the previous exception if one exists else returns null
     */
    final public function getPrevious()
    {
        return $this->previous;
    }
    
    /**
     * Get trace array as string
     *
     * @access public
     * @return string returns the trace array in string format
     */
    final public function getTraceAsString()
    {
        //not sure if you want to do this as i've seen it required a lot of apache resources
    }
    
    /**
     * ToString representation of Exception class
     *
     * @access public
     * @return string returns the exception being thrown in string format
     */
    public function __toString()
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}
