<?php
/**
 * PHP Sandbox
 *
 * @link https://github.com/amcgowanca/php-sandbox
 * @copyright Copyright (c) 2013 McGowan Corp. (http://www.mcgowancorp.com)
 * @license https://github.com/amcgowanca/PHP-Sandbox/blob/master/LICENSE.txt
 */

namespace PhpSandbox\Compiler\Tokenizer;

/**
 * Base token class used by all specialized tokens and represents a basic token.
 *
 * @author Aaron McGowan <aaron.mcgowan@mcgowancorp.com>
 * @package PhpSandbox.Compiler.Tokenizer
 * @version 1.0.0
 */
class Token
{
    // TODO: Complete absolute implementation of PHP's T_* to here as consts.
    const T_VARIABLE    = \T_VARIABLE;
    const T_WHITESPACE  = \T_WHITESPACE;
    
    /**
     * @var array An array of resolved token T_* types.
     */
    private static $resolved_token_names = array();
    
    /**
     * Resolves the name of the specified token code.
     *
     * @access public
     * @param int $token_code The token constant value.
     * @return string Returns the token type name.
     */
    public static function name($token_code)
    {
        if (!isset(self::$resolved_token_names[$token_code])) {
            // TODO: Complete - use reflection to perform resolution.
        }
        
        return self::$resolved_token_names[$token_code];
    }
  
    /**
     * @var string The type name.
     */
    private $type;
    
    /**
     * @var int The type code.
     */
    private $code;
    
    /**
     * @var mixed
     */
    private $value;
  
    /**
     * Creates a new instance of the Token class.
     *
     * @access public
     * @param string $type The token type.
     * @param int $type_code The token type code.
     * @param string $name The name of the token used to identify it.
     */
    public function __construct($type, $code, $value = null)
    {
        $this->type = $type;
        $this->code = $code;
        
        $this->value = $value;
    }
    
    /**
     * Returns the type of this token as a string.
     *
     * @access public
     * @return string Returns the token type constant name.
     */
    public function getType()
    {
        return $this->type;
    }
    
    /**
     * Returns the integer type of this token.
     *
     * @access public
     * @return int Returns the type code of this token.
     */
    public function getTypeCode()
    {
        return $this->code;
    }
    
    /**
     * Returns the value of this token.
     *
     * @access public
     * @return mixed Returns the value of this token.
     */
    public function getValue()
    {
        return $this->value;
    }
    
    /**
     * Returns a string representation of this token. Calls `$this->toString()`.
     *
     * @access public
     * @return string Returns a string representation.
     */
    final public function __toString()
    {
        return $this->toString();
    }
    
    /**
     * Returns a string representation of this token.
     *
     * If the token value has been set, the token value will be used as the
     * returned representation. If the token value is not set, will return
     * the type name of the token.
     *
     * @access public
     * @return string Returns a string representation.
     */
    public function toString()
    {
        return $this->value ? $this->value : $this->type;
    }
}
