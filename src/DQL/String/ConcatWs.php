<?php

namespace Luxifer\DQL\String;

use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\Lexer;
use Doctrine\ORM\Query\Parser;
use Doctrine\ORM\Query\SqlWalker;

/**
 * ConcatWsFunction ::= "CONCAT_WS" "(" StringPrimary "," StringPrimary "," StringPrimary ")"
 */
class ConcatWs extends FunctionNode
{
    public $strings = array();

    public function parse(Parser $parser)
    {
        $lexer = $parser->getLexer();

        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);

        $this->strings[] = $parser->StringPrimary(); // Separator
        $parser->match(Lexer::T_COMMA);

        $this->strings[] = $parser->StringPrimary();
        $parser->match(Lexer::T_COMMA);

        $this->strings[] = $parser->StringPrimary();

        while ($lexer->isNextToken(Lexer::T_COMMA)) {
            $parser->match(Lexer::T_COMMA);
            $this->strings[] = $parser->StringPrimary();
        }

        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }

    public function getSql(SqlWalker $sqlWalker)
    {
        $parts = array_map(array($sqlWalker, 'walkStringPrimary'), $this->strings);

        return sprintf('CONCAT_WS(%s)', implode(', ', $parts));
    }
}
