<?php
/**
 * PHP Sandbox
 *
 * @link https://github.com/amcgowanca/php-sandbox
 * @copyright Copyright (c) 2013 McGowan Corp. (http://www.mcgowancorp.com)
 * @license https://github.com/amcgowanca/PHP-Sandbox/blob/master/LICENSE.txt
 */

namespace PhpSandbox\Compiler\Tokenizer;

use PhpSandbox\Compiler\Tokenizer\Token;
use PhpSandbox\Compiler\Tokenizer\Tokens;
use PhpSandbox\Compiler\Tokenizer\Exception;
use PhpSandbox\Compiler\Tokenizer\Util as TokenUtility;

/**
 * A base tokenizer class for tokenizing a single input string of PHP source.
 *
 * This tokenizer class has been heavily influenced by PHPCS's PHP Tokenizer.
 *
 * @author Aaron McGowan <aaron.mcgowan@mcgowancorp.com>
 * @package PhpSandbox.Compiler.Tokenizer
 * @version 0.0.1
 */
class Tokenizer
{
    /**
     * @var Tokens An instance of tokens to represent that tokenized.
     */
    private $tokens = null;
    
    /**
     * @var bool Used to indicate whether or not process() has been done.
     */
    private $has_processed = false;
    
    /**
     * @var string The input string of source to tokenize.
     */
    private $input;
    
    /**
     * Creates a new instance of the Tokenizer class.
     *
     * @access public
     * @param string $input The input string to tokenize.
     * @throws Exception Thrown if the input string is empty.
     */
    public function __construct($input)
    {
        $input = trim($input);
        if (empty($input)) {
            throw new Exception('Tokenizer input cannot be empty.');
        }
        
        $this->input = $input;
    }
    
    /**
     * Returns a boolean used to indicate whether or not processing has occurred.
     *
     * @access public
     * @return bool Returns true if processing has occurred, otherwise false.
     */
    public function hasProcessed()
    {
        return $this->has_processed;
    }
    
    /**
     * Returns the Tokens collection object of token instances.
     *
     * If the tokenizer has not processed, the process will be called within.
     *
     * @access public
     * @return Tokens Returns the Tokens instance, a collection of tokens.
     */
    public function getTokens()
    {
        if (!$this->hasProcessed()) {
            $this->process();
        }
        
        return $this->tokens;
    }
    
    /**
     * Processes the input string that was specified at instantiation.
     *
     * @access public
     * @return Tokens Returns the Tokens instance.
     */
    public function process()
    {
        // If we have already processed, do not process again.
        if ($this->has_processed) {
            return $this->getTokens();
        }
        
        $tokens = @token_get_all($this->input);
        $tokens_count = count($tokens);
        
        $this->tokens = new Tokens();
        
        for ($token_iter = 0; $token_iter < $tokens_count; $tokens_iter++) {
            // If the token is a string, it is a special character token used
            // for denoting various things from assignment to math operators.
            if (is_string($tokens[$token_iter])) {
                // PHP will tokenize and process items within double quotations.
                if ('"' === $tokens[$token_iter]) {
                    // TODO: Complete
                }
            }
            else {
                // Perform a check on the character of the token
                if ("\r" === substr($tokens[$token_iter][1], -1)) {
                    $next = $token_iter + 1;
                    
                    // The `\r\n` newline characters are at times split, therefore check and merge.
                    if (isset($tokens[$next]) && is_array($tokens[$next]) && "\n" === $tokens[$next][1][0]) {
                        $tokens[$token_iter][1] .= "\n";
                        if ("\n" === $tokens[$next][1]) {
                            // If the next token is `\n`, skip.
                            $token_iter++;
                        }
                        else {
                            $tokens[$next][1] = substr($tokens[$next][1], 1);
                        }
                    }
                }
                
                // TODO: Complete
                
                
            } // end if (is_string()) else
        } // end for( $token_iter ... )
        
        $this->has_processed = true;
        
        return $this->getTokens();
    }
}

