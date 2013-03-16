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
    /**
     * @var string The type name.
     */
    private $type;
    
    /**
     * @var int The type code.
     */
    private $type_code;
    
    /**
     * @var string The name of this token that can be used to identify it.
     */
    private $name;
  
    /**
     * Creates a new instance of the Token class.
     *
     * @access public
     * @param string $type The token type.
     * @param int $type_code The token type code.
     * @param string $name The name of the token used to identify it.
     */
    public function __construct($type, $type_code, $name)
    {
        $this->type = $type;
        $this->type_code = $type_code;
        $this->name = $name;
    }
}
