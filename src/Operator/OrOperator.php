<?php
/**
 * Created by PhpStorm.
 * User: alamirault
 * Date: 21/04/19
 * Time: 16:31
 */

namespace Alamirault\Grammar\Operator;


use Alamirault\Grammar\Parser;
use Alamirault\Grammar\Result;

class OrOperator implements OperatorInterface
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
        foreach ($this->operators as $operator) {
            $result = $parser->parseOperator($operator, $input, $offset);
            if ($result->isMatch()) {
                return $result;
            }
        }
        return Result::noMatch($offset);
    }
}