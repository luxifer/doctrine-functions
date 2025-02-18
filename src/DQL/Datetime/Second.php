<?php

namespace Luxifer\DQL\Datetime;

use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\TokenType;
use Doctrine\ORM\Query\Parser;
use Doctrine\ORM\Query\SqlWalker;

/**
 * DateFunction ::= "SECOND" "(" ArithmeticPrimary ")"
 * @author Florent Viel <fviel@wanadev.fr>
 */
class Second extends FunctionNode
{
    public $dateExpression;

    public function parse(Parser $parser): void
    {
        $parser->match(TokenType::T_IDENTIFIER);
        $parser->match(TokenType::T_OPEN_PARENTHESIS);
        $this->dateExpression = $parser->ArithmeticPrimary();
        $parser->match(TokenType::T_CLOSE_PARENTHESIS);
    }

    public function getSql(SqlWalker $sqlWalker): string
    {
        return 'SECOND(' .
            $this->dateExpression->dispatch($sqlWalker) .
        ')'; 
    }
}
