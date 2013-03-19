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
 * Logger class
 *
 * @author Aaron McGowan <aaron.mcgowan@mcgowancorp.com>
 * @author Jeremy Mills <jeremy.mills89@gmail.com>
 * @package PhpSandbox
 * @version 0.0.1
 */
class Logger implements LoggerInterface, LoggerAwareInterface
{
    /**
     * CONSTANTS MEMBER VARIABLES
     */
    const EMERGENCY = 0;
    const ALERT     = 1;
    const CRITICAL  = 2;
    const ERROR     = 3;
    const WARNING   = 4;
    const NOTICE    = 5;
    const INFO      = 6;
    const DEBUG     = 7;
    const DEF       = 8;  // Default severity if none selected
    
    /**
     * Logger
     * @access private
     * @var Logger holds the current logger instance
     */
    private $_logger = null;
    
    /**
     * Has Logger
     * @access private
     * @var boolean shows whether or not class instance logger has been set
     */
    private $_has_logger = false;
    
    /**
     * Log File Path
     * @access private
     * @var string
     */
    private $_logFile = null;
    
    /**
     * File Status
     * @access private
     * @var resource
     */
    private $_fileStatus = null;
    
    /**
     * Messages created by class
     * @access private
     * @var array
     */
    private $_messages = array();
    
    /**
     * Default messages to be used
     * @access private
     * @var array
     */
    private $_default_message = array(
        'WriteFail' => 'File could not be written to. Check that permissions are correct.',
        'OpenFail' => 'File could not be opened. Check that permissions are correct.',
        'OpenSuccess' => 'File opened successfully.',
    );
    
    /**
     * Logger class construct
     *
     * @access public
     * @param string $logDir Holds the loging directory for file save
     * @param int $severity Integer value of severity constant
     */
    public function __construct($logDir = null, $severity = self::DEF)
    {
        if ($logDir !== null) {
            $logDir = rtrim($logDir, '\\/');
        } else {
            $logDir = dirname(__FILE__);
        }
        
        $this->_logFile = $logDir . DIRECTORY_SEPARATOR . 'log-' . date('Y-m-d') . '.txt';
        
        if (!file_exists($logDir)) {
            mkdir($logDir, 0777, true);
        }
        
        if (file_exists($this->_logFile) && !is_writable($this->_logFile)) {
            $this->_messages[] = $this->_default_messages['WriteFail'];
            throw new Exception($this->_default_message['WriteFail']);
        }
        if (($this->_fileStatus = fopen($this->_logFile, 'a'))) {
            $this->_messages[] = $this->_default_message['OpenSuccess'];
        } else {
            $this->_messages[] = $this->_default_message['OpenFail'];
            throw new Exception($this->_default_message['OpenFail']);
        }
    }
    
    /**
     * Destructor
     *
     * Will close the log file status
     *
     * @access public
     */
    public function __destruct()
    {
        if ($this->_fileStatus) {
            fclose($this->_fileStatus);
        }
    }
    
    /**
     * Emergency
     *
     * Writes an emergency message to the log
     *
     * @access public
     * @param string $message of emergency
     * @param array $context additional emergency data
     */
    public function emergency($message, array $context = array())
    {
        $this->log(self::EMERGENCY, $message, $context);
    }
    
    /**
     * Alert
     *
     * Writes an alert message to the log
     *
     * @access public
     * @param string $message of alert
     * @param array $context additional alert data
     */
    public function alert($message, array $context = array())
    {
        $this->log(self::ALERT, $message, $context);
    }
    
    /**
     * Critical Conditions
     *
     * Writes a critical message to the log
     *
     * @access public
     * @param string $message of critical instance
     * @param array $context additional critical data
     */
    public function critical($message, array $context = array())
    {
        $this->log(self::CRITICAL, $message, $context);
    }
    
    /**
     * Error
     *
     * Writes an error message to the log
     *
     * @access public
     * @param string $message of error
     * @param array $context additional error data
     */
    public function error($message, array $context = array())
    {
        $this->log(self::ERROR, $message, $context);
    }
    
    /**
     * Warning
     *
     * Writes a warning message to the log
     *
     * @access public
     * @param string $message of warning
     * @param array $context additional warning data
     */
    public function warning($message, array $context = array())
    {
        $this->log(self::WARNING, $message, $context);
    }
    
    /**
     * Notice
     *
     * Writes a notice message to the log
     * 
     * @access public
     * @param string $message of notice
     * @param array $context additional notice data
     */
    public function notice($message, array $context = array())
    {
        $this->log(self::NOTICE, $message, $context);
    }
    
    /**
     * Info
     *
     * Writes an info message to the log
     *
     * @access public
     * @param string $message of info
     * @param array $context additional info data
     */
    public function info($message, array $context = array())
    {
        $this->log(self::INFO, $message, $context);
    }
    
    /**
     * Debug
     *
     * Writes a debug message to the log
     *
     * @access public
     * @param string $message of debug log
     * @param array $context additional debug data
     */
    public function debug($message, array $context = array())
    {
        $this->log(self::DEBUG, $message, $context);
    }
    
    /**
     * Logs with level
     *
     * Writes a message to the log with a given severity level
     *
     * @access public
     * @param mixed $level
     * @param string $message of log
     * @param array $context additional log data
     */
    public function log($level, $message, array $context = array())
    {
        // Create the time stamp and error level
        $stamp = $this->timeStamp($level);
        // Concatinate the time stamp with message to be written to log file
        $input = "$stamp $message";
        
        // Write to the log file, will write to file if !== false
        if (fwrite($this->_fileStatus, $input) === false) {
            $this->_messages[] = $this->_default_message['WriteFail'];
            throw new Exception($this->_default_message['WriteFail']);
        }
    }
    
    /**
     * Sets a logger instance
     *
     * @access public
     * @param LoggerInterface $logger 
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->_logger = $logger;
        $this->_has_logger = (null !== $this->_logger);
    }
    
    /**
     * Get logger instance
     *
     * @access public
     * @return LoggerInterface $logger object
     */
    public function getLogger()
    {
        return $this->_logger;
    }
    
    /**
     * Get Message - Returns (and removes) last message created by class instance.
     * 
     * @return string
     */
    public function getMessage()
    {
        return array_pop($this->_messages);
    }

    /**
     * Get Messages - Returns (does not remove) all messages created by class instance.
     * 
     * @return array
     */
    public function getMessages()
    {
        return $this->_messages;
    }

    /**
     * Clear Message - Clears the array messages created by class instance.
     * @return void
     */
    public function clearMessages()
    {
        $this->_messages = array();
    }
    
    /**
     * Set timestamp with file level on file input
     *
     * @access private
     * @param int $level Class constant logging level
     */
    private function timeStamp($level)
    {
        $time = date('Y-m-d H:i:s');

        switch ($level) {
            case self::EMERGENCY:
                return "$time - [EMERGENCY] : ";
            case self::ALERT:
                return "$time - [ALERT] : ";
            case self::CRITICAL:
                return "$time - [CRITICAL] : ";
            case self::NOTICE:
                return "$time - [NOTICE] : ";
            case self::INFO:
                return "$time - [INFO] : ";
            case self::WARNING:
                return "$time - [WARNING] : ";
            case self::DEBUG:
                return "$time - [DEBUG] : ";
            case self::ERROR:
                return "$time - [ERROR] : ";
            default:
                return "$time - [LOG] : ";
        }
    }
}
