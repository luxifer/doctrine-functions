<?php

namespace Luxifer\DQL\String;

use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\Lexer;
use Doctrine\ORM\Query\Parser;
use Doctrine\ORM\Query\SqlWalker;

/**
 * ConcatWsFunction ::= "IF" "(" ConditionalExpression "," ArithmeticExpression "," ArithmeticExpression ")"
 */
class IfElse extends FunctionNode
{
    public $condition;
    public $isTrueStatement;
    public $isFalseStatement;

    public function parse(Parser $parser)
    {
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);
        $this->condition = $parser->ConditionalExpression();

        $parser->match(Lexer::T_COMMA);
        $this->isTrueStatement = $parser->ArithmeticExpression();

        $parser->match(Lexer::T_COMMA);
        $this->isFalseStatement = $parser->ArithmeticExpression();

        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }

    public function getSql(SqlWalker $sqlWalker)
    {
        return 'IF(' .
            $this->condition->dispatch($sqlWalker) . ', ' .
            $this->isTrueStatement->dispatch($sqlWalker) . ', ' .
            $this->isFalseStatement->dispatch($sqlWalker) .
        ')';
    }
}
