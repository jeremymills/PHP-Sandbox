<?php
/**
 * PHP Sandbox
 *
 * @link https://github.com/amcgowanca/php-sandbox
 * @copyright Copyright (c) 2013 McGowan Corp. (http://www.mcgowancorp.com)
 * @license https://github.com/amcgowanca/PHP-Sandbox/blob/master/LICENSE.txt
 */

namespace PhpSandbox\Compiler\Symbols;

/**
 *
 * @author Aaron McGowan <aaron.mcgowan@mcgowancorp.com>
 * @package PhpSandbox.Compiler.Symbols
 * @version 1.0.0
 */
class ScopedSymbol extends Symbol
{
    /**
     * Creates a new instance of the ScopedSymbol class.
     *
     * @access public
     * @param string $name The name of the symbol.
     */
    public function __construct($name)
    {
        parent::__construct($name);
    }
}
