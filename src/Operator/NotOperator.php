<?php
/**
 * Created by PhpStorm.
 * User: alamirault
 * Date: 23/04/19
 * Time: 19:25
 */

namespace Alamirault\Grammar\Operator;


use Alamirault\Grammar\Parser;
use Alamirault\Grammar\Result;

class NotOperator implements OperatorInterface
{
    /**
     * @var OperatorInterface
     */
    private $operator;


    /**
     * NotOperator constructor.
     */
    public function __construct(OperatorInterface $operator)
    {
        $this->operator = $operator;
    }

    public function find(Parser $parser, $input, $offset)
    {
        $result = $parser->parseOperator($this->operator, $input, $offset);
        if ($result->isMatch()) {
            return Result::noMatch($offset);
        }
        return Result::match(0, null, $offset);
    }
}