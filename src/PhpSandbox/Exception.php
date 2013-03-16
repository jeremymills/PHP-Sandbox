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
 * @author Jeremy Mills <jeremy.mills89@gmail.com>
 * @package PhpSandbox
 * @version 0.0.1
 */
class Exception extends \Exception
{
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
        $this->log($message, $code, $previous);

	parent::__construct($message, $code, $previous);
    }
    
    /**
     * Implement logging function for loging of exceptions thrown
     *
     * @access public
     * @param string $message of exception being thrown
     * @param int $code number of exception being thrown
     * @param \Exception $previous exception link if exists
     */
    public function log($message, $code, &$previous)
    {
	//TODO: Complete
    }
}
