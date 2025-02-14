<?php

namespace Luxifer\DQL\String;

use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\TokenType;
use Doctrine\ORM\Query\Parser;
use Doctrine\ORM\Query\SqlWalker;

/**
 * ConcatWsFunction ::= "CONCAT_WS" "(" StringPrimary "," StringPrimary "," StringPrimary ")"
 */
class ConcatWs extends FunctionNode
{
    public $strings = array();

    public function parse(Parser $parser): void
    {
        $lexer = $parser->getLexer();

        $parser->match(TokenType::T_IDENTIFIER);
        $parser->match(TokenType::T_OPEN_PARENTHESIS);

        $this->strings[] = $parser->StringPrimary(); // Separator
        $parser->match(TokenType::T_COMMA);

        $this->strings[] = $parser->StringPrimary();
        $parser->match(TokenType::T_COMMA);

        $this->strings[] = $parser->StringPrimary();

        while ($lexer->isNextToken(TokenType::T_COMMA)) {
            $parser->match(TokenType::T_COMMA);
            $this->strings[] = $parser->StringPrimary();
        }

        $parser->match(TokenType::T_CLOSE_PARENTHESIS);
    }

    public function getSql(SqlWalker $sqlWalker): string
    {
        $parts = array_map(array($sqlWalker, 'walkStringPrimary'), $this->strings);

        return sprintf('CONCAT_WS(%s)', implode(', ', $parts));
    }
}
