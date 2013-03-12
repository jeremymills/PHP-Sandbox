<?php
/**
 * PHP Sandbox
 *
 * @link https://github.com/amcgowanca/php-sandbox
 * @copyright Copyright (c) 2013 McGowan Corp. (http://www.mcgowancorp.com)
 * @license https://github.com/amcgowanca/PHP-Sandbox/blob/master/LICENSE.txt
 */

namespace PhpSandbox\Compiler;

use Psr\Log\LoggerInterface;
use Psr\Log\LoggerAwareInterface;

/**
 *
 */
class Compiler implements LoggerAwareInterface
{
    /**
     * @var \Psr\LoggerInterface A PSR compliant logger interface.
     */
    private $logger = null;
    
    /**
     *
     */
    public function __construct()
    {
        
    }
    
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
    
    public function run()
    {
        
    }
}
