<?php
/**
 * Created by PhpStorm.
 * User: alamirault
 * Date: 21/04/19
 * Time: 16:21
 */

namespace Alamirault\Grammar\Operator;


use Alamirault\Grammar\Parser;
use Alamirault\Grammar\Result;

class AndOperator implements OperatorInterface
{
    /**
     * @var array
     */
    private $operators;


    /**
     * Sequence constructor.
     * @param OperatorInterface[] $operators
     */
    public function __construct(...$operators)
    {
        $this->operators = $operators;
    }

    public function find(Parser $parser, $input, $offset)
    {
        $_offset = $offset;
        $matches = [];
        $matchLen = 0;

        foreach ($this->operators as $operator) {
            $result = $parser->parseOperator($operator, $input, $offset);

            if (!$result->isMatch()) {
                return Result::noMatch($_offset);
            }


            $offset = $result->newOffset();
            $matches[] = $result->value();
            $matchLen += $result->length();
        }

        return Result::match($matchLen, $matches, $_offset);
    }
}