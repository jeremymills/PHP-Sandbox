<?php
/**
 * PHP Sandbox
 *
 * @link https://github.com/amcgowanca/php-sandbox
 * @copyright Copyright (c) 2013 McGowan Corp. (http://www.mcgowancorp.com)
 * @license https://github.com/amcgowanca/PHP-Sandbox/blob/master/LICENSE.txt
 */

namespace PhpSandbox\Compiler\Tokenizer\Token;

/**
 * Base token class used by all specialized tokens and represents a basic token.
 *
 * @author Aaron McGowan <aaron.mcgowan@mcgowancorp.com>
 * @package PhpSandbox.Compiler.Tokenizer.Token
 * @version 1.0.0
 */
class Token
{
    /**
     * Constants that define a token's type. Most have been mimiced from
     * PHP's predefined (http://www.php.net/manual/en/tokens.php) in addition
     * to a handful borrowed from PHPCS.
     */
    const T_ABSTRACT                    = \T_ABSTRACT;
    const T_AND_EQUAL                   = \T_AND_EQUAL;
    const T_ARRAY                       = \T_ARRAY;
    const T_ARRAY_CAST                  = \T_ARRAY_CAST;
    const T_AS                          = \T_AS;
    const T_BAD_CHARACTER               = \T_BAD_CHARACTER;
    const T_BOOLEAN_AND                 = \T_BOOLEAN_AND;
    const T_BOOLEAN_OR                  = \T_BOOLEAN_OR;
    const T_BOOL_CAST                   = \T_BOOL_CAST;
    const T_BREAK                       = \T_BREAK;
    const T_CALLABLE                    = \T_CALLABLE;
    const T_CASE                        = \T_CASE;
    const T_CATCH                       = \T_CATCH;
    const T_CHARACTER                   = \T_CHARACTER;
    const T_CLASS                       = \T_CLASS;
    const T_CLASS_C                     = \T_CLASS_C;
    const T_CLONE                       = \T_CLONE;
    const T_CLOSE_TAG                   = \T_CLOSE_TAG;
    const T_COMMENT                     = \T_COMMENT;
    const T_CONCAT_EQUAL                = \T_CONCAT_EQUAL;
    const T_CONST                       = \T_CONST;
    const T_CONSTANT_ESCAPED_STRING     = \T_CONSTANT_ENCAPSED_STRING;
    const T_CONTINUE                    = \T_CONTINUE;
    const T_CURLY_OPEN                  = \T_CURLY_OPEN;
    const T_DEC                         = \T_DEC;
    const T_DECLARE                     = \T_DECLARE;
    const T_DEFAULT                     = \T_DEFAULT;
    const T_DIR                         = \T_DIR;
    const T_DIV_EQUAL                   = \T_DIV_EQUAL;
    const T_DNUMBER                     = \T_DNUMBER;
    const T_DOC_COMMENT                 = \T_DOC_COMMENT;
    const T_DO                          = \T_DO;
    const T_DOLLAR_OPEN_CURLY_BRACES    = \T_DOLLAR_OPEN_CURLY_BRACES;
    const T_DOUBLE_ARROW                = \T_DOUBLE_ARROW;
    const T_DOUBLE_CAST                 = \T_DOUBLE_CAST;
    const T_DOUBLE_COLON                = \T_DOUBLE_COLON;
    const T_ECHO                        = \T_ECHO;
    const T_ELSE                        = \T_ELSE;
    const T_ELSEIF                      = \T_ELSEIF;
    const T_EMPTY                       = \T_EMPTY;
    const T_ENCAPSED_AND_WHITESPACE     = \T_ENCAPSED_AND_WHITESPACE;
    const T_ENDDECLARE                  = \T_ENDDECLARE;
    const T_ENDFOR                      = \T_ENDFOR;
    const T_ENDFOREACH                  = \T_ENDFOREACH;
    const T_ENDIF                       = \T_ENDIF;
    const T_ENDSWITCH                   = \T_ENDSWITCH;
    const T_ENDWHILE                    = \T_ENDWHILE;
    const T_END_HEREDOC                 = \T_END_HEREDOC;
    const T_EVAL                        = \T_EVAL;
    const T_EXIT                        = \T_EXIT;
    const T_EXTENDS                     = \T_EXTENDS;
    const T_FILE                        = \T_FILE;
    const T_FINAL                       = \T_FINAL;
    const T_FOR                         = \T_FOR;
    const T_FOREACH                     = \T_FOREACH;
    const T_FUNCTION                    = \T_FUNCTION;
    const T_FUNC_C                      = \T_FUNC_C;
    const T_GLOBAL                      = \T_GLOBAL;
    const T_GOTO                        = \T_GOTO;
    const T_HALT_COMPILER               = \T_HALT_COMPILER;
    const T_IF                          = \T_IF;
    const T_IMPLEMENTS                  = \T_IMPLEMENTS;
    const T_INC                         = \T_INC;
    const T_INCLUDE                     = \T_INCLUDE;
    const T_INCLUDE_ONCE                = \T_INCLUDE_ONCE;
    const T_INLINE_HTML                 = \T_INLINE_HTML;
    const T_INSTANCEOF                  = \T_INSTANCEOF;
    const T_INSTEADOF                   = \T_INSTEADOF;
    const T_INT_CAST                    = \T_INT_CAST;
    const T_INTERFACE                   = \T_INTERFACE;
    const T_ISSET                       = \T_ISSET;
    const T_IS_EQUAL                    = \T_IS_EQUAL;
    const T_IS_GREATER_OR_EQUAL         = \T_IS_GREATER_OR_EQUAL;
    const T_IS_IDENTICAL                = \T_IS_IDENTICAL;
    const T_IS_NOT_EQUAL                = \T_IS_NOT_EQUAL;
    const T_IS_NOT_IDENTICAL            = \T_IS_NOT_IDENTICAL;
    const T_IS_SMALLER_OR_EQUAL         = \T_IS_SMALLER_OR_EQUAL;
    const T_LINE                        = \T_LINE;
    const T_LIST                        = \T_LIST;
    const T_LNUMBER                     = \T_LNUMBER;
    const T_LOGICAL_AND                 = \T_LOGICAL_AND;
    const T_LOGICAL_OR                  = \T_LOGICAL_OR;
    const T_LOGICAL_XOR                 = \T_LOGICAL_XOR;
    const T_METHOD_C                    = \T_METHOD_C;
    const T_MINUS_EQUAL                 = \T_MINUS_EQUAL;
    const T_ML_COMMENT                  = \T_DOC_COMMENT; // T_ML_COMMENT is only available in PHP 4
    const T_MOD_EQUAL                   = \T_MOD_EQUAL;
    const T_MUL_EQUAL                   = \T_MUL_EQUAL;
    const T_NAMESPACE                   = \T_NAMESPACE;
    const T_NS_C                        = \T_NS_C;
    const T_NS_SEPARATOR                = \T_NS_SEPARATOR;
    const T_NEW                         = \T_NEW;
    const T_NUM_STRING                  = \T_NUM_STRING;
    const T_OBJECT_CAST                 = \T_OBJECT_CAST;
    const T_OBJECT_OPERATOR             = \T_OBJECT_OPERATOR;
    const T_OPEN_TAG                    = \T_OPEN_TAG;
    const T_OPEN_TAG_WITH_ECHO          = \T_OPEN_TAG_WITH_ECHO;
    const T_OR_EQUAL                    = \T_OR_EQUAL;
    const T_PAAMAYIM_NEKUDOTAYIM        = \T_DOUBLE_COLON; // Alias
    const T_PLUS_EQUAL                  = \T_PLUS_EQUAL;
    const T_PRINT                       = \T_PRINT;
    const T_PRIVATE                     = \T_PRIVATE;
    const T_PROTECTED                   = \T_PROTECTED;
    const T_PUBLIC                      = \T_PUBLIC;
    const T_REQUIRE                     = \T_REQUIRE;
    const T_REQUIRE_ONCE                = \T_REQUIRE_ONCE;
    const T_RETURN                      = \T_RETURN;
    const T_SL                          = \T_SL;
    const T_SL_EQUAL                    = \T_SL_EQUAL;
    const T_SR                          = \T_SR;
    const T_SR_EQUAL                    = \T_SR_EQUAL;
    const T_START_HEREDOC               = \T_START_HEREDOC;
    const T_STATIC                      = \T_STATIC;
    const T_STRING                      = \T_STRING;
    const T_STRING_CAST                 = \T_STRING_CAST;
    const T_STRING_VARNAME              = \T_STRING_VARNAME;
    const T_SWITCH                      = \T_SWITCH;
    const T_THROW                       = \T_THROW;
    const T_TRAIT                       = \T_TRAIT;
    const T_TRAIT_C                     = \T_TRAIT_C;
    const T_TRY                         = \T_TRY;
    const T_UNSET                       = \T_UNSET;
    const T_UNSET_CAST                  = \T_UNSET_CAST;
    const T_USE                         = \T_USE;
    const T_VAR                         = \T_VAR; // Support began in PHP 4, with class member vars as var.
    const T_VARIABLE                    = \T_VARIABLE;
    const T_WHILE                       = \T_WHILE;
    const T_WHITESPACE                  = \T_WHITESPACE;
    const T_XOR_EQUAL                   = \T_XOR_EQUAL;
    
    // Many thanks to PHPCS for the below list.
    const T_NONE                        = 0;
    const T_OPEN_CURLY_BRACKET          = 1000;
    const T_CLOSE_CURLY_BRACKET         = 1001;
    const T_OPEN_SQUARE_BRACKET         = 1002;
    const T_CLOSE_SQUARE_BRACKET        = 1003;
    const T_OPEN_PARANTHESIS            = 1004;
    const T_CLOSE_PARANTHESIS           = 1005;
    const T_COLON                       = 1006;
    const T_STRING_CONCAT               = 1007;
    const T_INLINE_THEN                 = 1008;
    const T_INLINE_ELSE                 = 1009;
    const T_NULL                        = 1010;
    const T_FALSE                       = 1011;
    const T_TRUE                        = 1012;
    const T_SEMICOLON                   = 1013;
    const T_EQUAL                       = 1014;
    const T_MULTIPLE                    = 1015;
    const T_DIVIDE                      = 1016;
    const T_PLUS                        = 1017;
    const T_MINUS                       = 1018;
    const T_MODULUS                     = 1019;
    const T_POWER                       = 1020;
    const T_BITWISE_AND                 = 1021;
    const T_BITWISE_OR                  = 1022;
    const T_ARRAY_HINT                  = 1023;
    const T_GREATER_THAN                = 1024;
    const T_LESS_THAN                   = 1025;
    const T_BOOLEAN_NOT                 = 1026;
    const T_SELF                        = 1027;
    const T_PARENT                      = 1028;
    const T_DOUBLE_QUOTED_STRING        = 1029;
    const T_COMMA                       = 1030;
    const T_HEREDOC                     = 1031;
    // const T_PROTOTYPE                   = 1032;
    const T_THIS                        = 1033;
    // const T_REGULAR_EXPRESSION          = 1034;
    // const T_PROPERTY                    = 1035;
    // const T_LABEL                       = 1036;
    // const T_OBJECT                      = 1037;
    // const T_COLOR                       = 1038;
    // const T_HASH                        = 1039;
    // const T_URL                         = 1040;
    // const T_STYLE                       = 1041;
    const T_ASPERAND                    = 1042; // @ sign, in PHP used to surpress errors of a function.
    const T_DOLLAR                      = 1043;
    // const T_TYPEOF                      = 1044;
    const T_CLOSURE                     = 1045;
    const T_BACKTICK                    = 1046;
    const T_START_NOWDOC                = 1047;
    const T_NOWDOC                      = 1048;
    const T_END_NOWDOC                  = 1049;
    const T_OPEN_SHORT_ARRAY            = 1050;
    const T_CLOSE_SHORT_ARRAY           = 1051;
    
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
            // Uses reflection to get all T_* defined constants within
            // this class so that they can be statically cached at runtime.
            try {
                $reflector = new \ReflectionClass(get_called_class());
                $constants = $reflector->getConstants();
                
                foreach ($constants as $name => $code) {
                    if (0 !== strpos($name, 'T_')) {
                        continue;
                    }
                    
                    self::$resolved_token_names[$code] = $name;
                }
            } catch (\ReflectionException $exception) {
                throw $exception;
            }
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
