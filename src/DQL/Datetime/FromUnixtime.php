<?php

namespace Luxifer\DQL\Datetime;

use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\TokenType;
use Doctrine\ORM\Query\Parser;
use Doctrine\ORM\Query\SqlWalker;

/**
 * DateFunction ::= "FROM_UNIXTIME" "(" ArithmeticPrimary "," StringPrimary ")"
 */
class FromUnixtime extends FunctionNode
{
    public $dateExpression;
    public $dateFormat;

    public function parse(Parser $parser): void
    {
        $parser->match(TokenType::T_IDENTIFIER);
        $parser->match(TokenType::T_OPEN_PARENTHESIS);

        $this->dateExpression = $parser->ArithmeticPrimary();
        $parser->match(TokenType::T_COMMA);
        $this->dateFormat = $parser->StringPrimary();

        $parser->match(TokenType::T_CLOSE_PARENTHESIS);
    }

    public function getSql(SqlWalker $sqlWalker): string
    {
        $parts = array(
            $sqlWalker->walkArithmeticPrimary($this->dateExpression),
            $sqlWalker->walkStringPrimary($this->dateFormat)
        );

        return sprintf('FROM_UNIXTIME(%s)', implode(', ', $parts));
    }
}
