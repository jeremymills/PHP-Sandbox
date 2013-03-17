<?php
/**
 * PHP Sandbox
 *
 * @link https://github.com/amcgowanca/php-sandbox
 * @copyright Copyright (c) 2013 McGowan Corp. (http://www.mcgowancorp.com)
 * @license https://github.com/amcgowanca/PHP-Sandbox/blob/master/LICENSE.txt
 */

namespace PhpSandbox\Compiler\Tokenizer;

use PhpSandbox\Compiler\Tokenizer\Token\Token;
use PhpSandbox\Compiler\Tokenizer\Token\Tokens;
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
        if (!is_string($input)) {
            throw new Exception('Tokenizer input is expected to be a string.');
        }
        
        // Trim possible whitespace on left-and-right.
        $input = trim($input);
        
        // Ensure its not empty
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
        
        // Primary loop construct for traversing original tokens to properly
        // process them and build the Tokens list.
        for ($token_iter = 0; $token_iter < $tokens_count; $token_iter++) {
            // If the token is a string, it is a special character token used
            // for denoting various things from assignment to math operators.
            if (is_array($tokens[$token_iter])) {
                // TODO: Complete implementation of tokens that are arrays
                switch ($tokens[$token_iter][0]) {
                    case Token::T_WHITESPACE:
                        $this->processWhiteSpaceToken($tokens, $token_iter);
                        break;
                } // end switch (...)
                
                // Create new token object
                $token = new Token(
                    $tokens[$token_iter][0],
                    Token::name($tokens[$token_iter][0]),
                    isset($tokens[$token_iter][1]) ? $tokens[$token_iter][1] : null
                );
                
                // Add token to the tokens collection
                $this->tokens->push($token);
            }
            else {
              switch ($tokens[$token_iter]) {
                    // PHP tokenizes double quoted strings and evaluates. We must as well.
                    case '"':
                        $token_value = $this->processEscapedAndWhitespace($tokens, $tokens_count, $token_iter);
                        
                        // TODO: This should be moved eventually to the process* method.
                        $token = new Token(null, null, $token_value);
                        $this->tokens->push($token);
                        
                        break;
                    
                    default:
                        $token = new Token(null, null, $tokens[$token_iter]);
                        $this->tokens->push($token);
                        break;
                } // end switch (...)
            } // end if (is_string()) else
        } // end for( $token_iter ... )
        
        $this->has_processed = true;
        
        return $this->getTokens();
    }
    
    /**
     * Handles the parsing of whitespace tokens.
     *
     * @access protected
     * @param array $tokens The current token stack as an array, passed by reference.
     * @param int $token_iter The current token stack position, passed by reference.
     */
    protected function processWhiteSpaceToken(array &$tokens, &$token_iter)
    {
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
    }
    
    /**
     * Handles the processing of double-quoted or escaped and whitespace tokens.
     *
     * @access public
     * @param array $tokens The current token stack as an array, passed by reference.
     * @param int $tokens_count The count of the token stack.
     * @param int $token_iter The current token stack position, passed by reference.
     * @return string Returns the token value properly parsed.
     */
    protected function processEscapedAndWhitespace(array &$tokens, $tokens_count, &$token_iter)
    {
        $inner = array();
        $token_value = '"';
        
        // The for-loop initializer should increment the token_iter to account
        // for the token_value already having assigned the double quotation.
        for ($token_iter++; $token_iter < $tokens_count; $token_iter++) {
            if (is_array($tokens[$token_iter])) {
                $token_value .= $tokens[$token_iter][1];
                if ('{' === $tokens[$token_iter][1] && T_ENCAPSED_AND_WHITESPACE !== $tokens[$token_iter][0]) {
                    $inner[] = $token_iter;
                }
            }
            else {
                $token_value .= $tokens[$token_iter];
                if ('}' === $tokens[$token_iter]) {
                    array_pop($inner);
                }
                
                // Is the string closing?
                if ('"' === $tokens[$token_iter] && empty($inner)) {
                    break;
                }
            }
        }
        
        return $token_value;
    }
}

