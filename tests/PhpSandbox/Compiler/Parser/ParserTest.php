<?php
/**
 * PHP Sandbox
 *
 * @link https://github.com/amcgowanca/php-sandbox
 * @copyright Copyright (c) 2013 McGowan Corp. (http://www.mcgowancorp.com)
 * @license https://github.com/amcgowanca/PHP-Sandbox/blob/master/LICENSE.txt
 */

namespace PhpSandbox\Compiler\Parser\Tests;

use PHPUnit_Framework_TestCase;
use PhpSandbox\Compiler\Parser\Parser;

class ParserTest extends PHPUnit_Framework_TestCase
{
    public function testParseEcho()
    {
        $parser = new Parser();
        $parser->parse('<?php print "Hello World"; ?>');
        $code_blocks = $parser->getCodeBlocks();
        $this->assertEquals('<?php print "Hello World"; ?>', implode('', $code_blocks));
        
        $parser = new Parser();
        $parser->parse('<?php echo "Hello World"; ?>');
        $code_blocks = $parser->getCodeBlocks();
        $this->assertEquals('<?php echo "Hello World"; ?>', implode('', $code_blocks));
        
        // Parser for echo() and print() which should NOT be allowed, these are
        // language constructs not functions.
    }
    
    public function testParseVariables()
    {
        $parser = new Parser();
        $parser->parse('<?php $variable = "Hello World"; ?>');
        $code_blocks = $parser->getCodeBlocks();
        $this->assertEquals('<?php $variable = "Hello World"; ?>', implode('', $code_blocks));
      
        $parser = new Parser();
        $parser->parse('<?php $variable = "Hello World"; $second = $variable; ?>');
        $code_blocks = $parser->getCodeBlocks();
        $this->assertEquals('<?php $variable = "Hello World"; $second = $variable; ?>', implode('', $code_blocks));
        
        $parser = new Parser();
        $parser->parse('<?php $variable = $second = "Hello World"; ?>');
        $code_blocks = $parser->getCodeBlocks();
        $this->assertEquals('<?php $variable = $second = "Hello World"; ?>', implode('', $code_blocks));
        
        $parser = new Parser();
        $parser->parse('<?php $variable = "eval"; $variable("echo \"hello world\";"); ?>');
        $code_blocks = $parser->getCodeBlocks();
        $this->assertEquals('<?php $variable = "eval"; $variable("echo \"hello world\";"); ?>', implode('', $code_blocks));
      
        /* $parser = new Parser();
        $parser->parse('<?php $variable = function() { }; ?>');
        $code_blocks = $parser->getCodeBlocks();
        $this->assertEquals('<?php $variable = function() { }; ?>', implode('', $code_blocks)); */
    }
    
    public function testParseFunctions()
    {
        $parser = new Parser();
        $parser->parse('<?php function foo() { print "Hello World"; } ?>');
        $code_blocks = $parser->getCodeBlocks();
        $this->assertEquals('<?php function foo() { print "Hello World"; } ?>', implode('', $code_blocks));
        
        // print_r( $code_blocks );
    }
    
    public function testTokensGetAll() {
      /* print_r( token_get_all('<?php $variable = "Hello World"; ?>')); */
      /* print_r( token_get_all('<?php print $variable; ?>') ); */
      /* print_r( token_get_all('<?php $variable = "eval"; $variable("echo \"hello world\";"); ?>') ); */
      /* print_r( token_get_all('<?php function foo() { print "Hello World"; } ?>') ); */
    }
}
