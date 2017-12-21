<?php

namespace Luxifer\DQL\Datetime;

use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\Lexer;
use Doctrine\ORM\Query\Parser;
use Doctrine\ORM\Query\SqlWalker;

/**
 * DateFunction ::= "DATE_FORMAT" "(" ArithmeticPrimary "," StringPrimary ")"
 */
class DateFormat extends FunctionNode
{
    public $dateExpression;
    public $dateFormat;

    public function parse(Parser $parser)
    {
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);

        $this->dateExpression = $parser->ArithmeticPrimary();
        $parser->match(Lexer::T_COMMA);

        $this->dateFormat = $parser->StringPrimary();

        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }

    public function getSql(SqlWalker $sqlWalker)
    {
        $parts = array(
            $sqlWalker->walkArithmeticPrimary($this->dateExpression),
            $sqlWalker->walkStringPrimary($this->dateFormat)
        );

        return sprintf('DATE_FORMAT(%s)', implode(', ', $parts));
    }
}
