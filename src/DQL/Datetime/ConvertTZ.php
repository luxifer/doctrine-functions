<?php

namespace Luxifer\DQL\Datetime;

use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\TokenType;
use Doctrine\ORM\Query\Parser;
use Doctrine\ORM\Query\SqlWalker;

/**
 * DateFunction ::= "CONVERT_TZ" "(" ArithmeticPrimary "," StringPrimary "," StringPrimary ")"
 */
class ConvertTZ extends FunctionNode
{
    public $dateExpression;
    public $fromTZ;
    public $toTZ;

    public function parse(Parser $parser): void
    {
        $parser->match(TokenType::T_IDENTIFIER);
        $parser->match(TokenType::T_OPEN_PARENTHESIS);

        $this->dateExpression = $parser->ArithmeticPrimary();
        $parser->match(TokenType::T_COMMA);

        $this->fromTZ = $parser->StringPrimary();
        $parser->match(TokenType::T_COMMA);

        $this->toTZ = $parser->StringPrimary();

        $parser->match(TokenType::T_CLOSE_PARENTHESIS);
    }

    public function getSql(SqlWalker $sqlWalker): string
    {
        $parts = array(
            $sqlWalker->walkArithmeticPrimary($this->dateExpression),
            $sqlWalker->walkStringPrimary($this->fromTZ),
            $sqlWalker->walkStringPrimary($this->toTZ)
        );

        return sprintf('CONVERT_TZ(%s)', implode(', ', $parts));
    }
}
