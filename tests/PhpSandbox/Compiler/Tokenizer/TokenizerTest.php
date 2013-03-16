<?php
/**
 * PHP Sandbox
 *
 * @link https://github.com/amcgowanca/php-sandbox
 * @copyright Copyright (c) 2013 McGowan Corp. (http://www.mcgowancorp.com)
 * @license https://github.com/amcgowanca/PHP-Sandbox/blob/master/LICENSE.txt
 */

namespace PhpSandbox\Compiler\Tokenizer\Tests;

use PhpSandbox\Compiler\Tokenizer\Tokenizer;
use PhpSandbox\Compiler\Tokenizer\Exception;

/**
 *
 *
 */
class TokenizerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException PhpSandbox\Compiler\Tokenizer\Exception
     */
    public function testEmptyConstructor()
    {
        $tokenizer = new Tokenizer('');
    }
    
    /**
     * @expectedException PhpSandbox\Compiler\Tokenizer\Exception
     */
    public function testNullConstructor()
    {
        $tokenizer = new Tokenizer(null);
    }
    
    public function testHasProcessBeforeProcess()
    {
        $tokenizer = new Tokenizer('<?php print "Hello"; ?>');
        $this->assertFalse($tokenizer->hasProcessed());
    }
    
    public function testHasProcessAfterProcess()
    {
        $tokenizer = new Tokenizer('<?php print "Hello"; ?>');
        $tokenizer->process();
        $this->assertTrue($tokenizer->hasProcessed());
    }
    
    public function testSimpleProcessAsString()
    {
        $tokenizer = new Tokenizer('<?php print "Hello World"; ?>');
        $tokens = $tokenizer->getTokens();
        $this->assertEquals('<?php print "Hello World"; ?>', $tokens->toString());
    }
    
    public function testSimpleHtmlAsString()
    {
        $tokenizer = new Tokenizer('<html><head><title>Hello World</title></head><body><body></html>');
        $tokens = $tokenizer->getTokens();
        $this->assertEquals('<html><head><title>Hello World</title></head><body><body></html>', $tokens->toString());
        $this->assertCount(1, $tokens);
    }
    
    public function testProcessWithEscapedAndWhitespace()
    {
        $tokenizer = new Tokenizer('<?php $variable = \'Hello World\'; print "$variable"; ?>');
        $tokens = $tokenizer->getTokens();
        $this->assertEquals('<?php $variable = \'Hello World\'; print "$variable"; ?>', $tokens->toString());
    }
}
