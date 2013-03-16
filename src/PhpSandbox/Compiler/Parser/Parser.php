<?php
/**
 * PHP Sandbox
 *
 * @link https://github.com/amcgowanca/php-sandbox
 * @copyright Copyright (c) 2013 McGowan Corp. (http://www.mcgowancorp.com)
 * @license https://github.com/amcgowanca/PHP-Sandbox/blob/master/LICENSE.txt
 */

namespace PhpSandbox\Compiler\Parser;

use PhpSandbox\Compiler\Symbols\ValueSymbol;
use PhpSandbox\Compiler\Symbols\SymbolTable;

use PhpSandbox\Compiler\Tokenizer\Token;
use PhpSandbox\Compiler\Tokenizer\Tokens;
use PhpSandbox\Compiler\Tokenizer\Tokenizer;

use Psr\Log\LoggerInterface;
use Psr\Log\LoggerAwareInterface;

/**
 *
 * @author Aaron McGowan <aaron.mcgowan@mcgowancorp.com>
 * @package PhpSandbox.Compiler.Parser
 * @version 0.0.1
 */
class Parser implements LoggerAwareInterface
{
    private $logger = null;
    private $has_logger = false;
    
    private $symbols = null;
    
    private $tokens = array();
    private $tokens_count = 0;
    
    private $code_blocks = array();
    
    private $has_parsed = false;
    
    /**
     * Creates a new Parser instance.
     *
     * @access public
     * @param SymbolTable The symbol table instance to use.
     */
    public function __construct(SymbolTable $symbol_table = null)
    {
        if (null === $symbol_table)
        {
            $symbol_table = new SymbolTable();
        }
        
        $this->symbols = $symbol_table;
        
    }
    
    final public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
        $this->has_logger = null !== $this->logger;
    }
    
    final protected function hasLogger()
    {
        return $this->has_logger;
    }
    
    final protected function getLogger()
    {
        return $this->logger;
    }
    
    public function hasParsed()
    {
        return $this->has_parsed;
    }
    
    public function getCodeBlocks()
    {
        return $this->code_blocks;
    }
    
    /**
     *
     * @access public
     * @param string $input
     */
    public function parse($input)
    {
        if ($this->hasParsed()) {
            return;
        }
        
        $tokenizer = new Tokenizer($input);
        $this->tokens = $tokenizer->getTokens();
        
        if (0 === $this->tokens->count()) {
            return;
        }
        
        
        
        
        /* 
        $this->code_blocks = array();
        
        while ($token = array_shift($this->tokens)) {
            switch ($token[0]) {
                case T_OPEN_TAG:
                    $this->code_blocks[] = '<?php ';
                    break;
                
                case T_CLOSE_TAG:
                    $this->code_blocks[] = '?>';
                    break;
                
                case T_WHITESPACE:
                    $this->code_blocks[] = $token[1];
                    break;
                
                case T_VARIABLE:
                    $variable_blocks =  $this->parseVariable($token);
                    $this->mergeCodeBlocks($variable_blocks);
                    break;
                
                case T_PRINT:
                case T_ECHO:
                    $this->code_blocks[] = $token[1];
                    break;
                
                case T_CONSTANT_ENCAPSED_STRING:
                    $this->code_blocks[] = $token[1];
                    break;
                
                case T_FUNCTION:
                    $function_blocks = $this->parseFunction($token);
                    $this->mergeCodeBlocks($function_blocks);
                    break;
                
                case ';': // T_SEMICOLON?
                    $this->code_blocks[] = ';';
                    break;
                
                case '=':
                case '(':
                case ')':
                    break;
                
                default:
                    if ($this->hasLogger()) {
                        // TODO: Complete, log unknown token type
                    }
                    break;
            }
        } */
        
        $this->has_parsed = true;
    }
    
    protected function mergeCodeBlocks(array &$code_blocks) {
        for ($i = 0; $i < count($code_blocks); ++$i) {
            $this->code_blocks[] = $code_blocks[$i];
        }
    }
    
    /**
     *
     * @access protected
     */
    protected function parseFunction($function_token)
    {
        // Check to make the function is defined, whether by php or in user land.
        // This method should not parse static class method calls.
        
        /* $code_blocks = array($function_token[1]);
        
        $break = false;
        
        while (!$break && ($token = array_shift($this->tokens))) {
            
            switch ($token[0]) {
                case T_WHITESPACE:
                    $code_blocks[] = $token[1];
                    break;
                
                case T_STRING:
                    $code_blocks[] = $token[1];
                    break;
                
                case T_PRINT:
                case T_ECHO:
                    $code_blocks[] = $token[1];
                    break;
                
                case T_VARIABLE:
                    $variable_blocks = $this->parseVariable($token);
                    $this->mergeCodeBlocks($variable_blocks);
                    break;
                
                case T_CONSTANT_ENCAPSED_STRING:
                    $code_blocks[] = $token[1];
                    break;
                
                case '(':
                    $code_blocks[] = $token[0];
                    break;
                
                case ')':
                    $code_blocks[] = $token[0];
                    break;
                
                case '{':
                    $code_blocks[] = $token[0];
                    break;
                
                case '}':
                    $code_blocks[] = $token[0];
                    $break = true;
                    break;
                
                case ';':
                    $code_blocks[] = $token[0];
                    break;
            }
        }
        
        return $code_blocks; */
    }
    
    /**
     *
     * @access protected
     * @param array $variable_token The token that represents a variable.
     */
    protected function parseVariable($variable_token)
    {
        /* $code_blocks = array($variable_token[1]);
        $var_is_assign = false;
        
        // Used to break out of the loop
        $break = false;
        
        // Check $break prior to popping off another token from the beginning
        // because if not, then a pop occurs then the actual break. This is not
        // what we want to achieve, as we will miss the next token in our main
        // parse method.
        while (!$break && ($token = array_shift($this->tokens))) {
            switch ($token[0]) {
                case T_WHITESPACE:
                    $code_blocks[] = $token[1];
                    break;
                
                case T_CONSTANT_ENCAPSED_STRING:
                    $code_blocks[] = $token[1];
                    if ($var_is_assign) {
                        $this->symbols->set(new ValueSymbol($variable_token[1], $token[1]));
                    }
                    break;
                
                case T_VARIABLE:
                    if ($var_is_assign) {
                        if (!$this->symbols->exists($token[1])) {
                            if ($this->hasLogger()) {
                                // TODO: Log error, use of undefined variable.
                            }
                            
                            // TODO: Compiler error/warning
                        }
                        
                        $code_blocks[] = $token[1];
                        $this->symbols->set(new ValueSymbol($variable_token[1], $token[1]));
                    }
                    break;
                
                case '(':
                    $code_blocks[] = '(';
                    break;
                
                case ')':
                    $code_blocks[] = ')';
                    break;
                
                case '=':
                    $var_is_assign = true;
                    $code_blocks[] = '=';
                    break;
                
                case ';':
                    $code_blocks[] = ';';
                    $var_is_assign = false;
                    $break = true;
                    break;
            }
        } // end while (...)
        
        return $code_blocks; */
    }
}
