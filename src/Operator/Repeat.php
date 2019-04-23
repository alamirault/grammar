<?php
/**
 * Created by PhpStorm.
 * User: alamirault
 * Date: 21/04/19
 * Time: 16:11
 */

namespace Alamirault\Grammar\Operator;


use Alamirault\Grammar\Parser;
use Alamirault\Grammar\Result;

class Repeat implements OperatorInterface
{
    /**
     * @var OperatorInterface
     */
    private $operatorToRepeat;
    /**
     * @var int
     */
    private $min;
    /**
     * @var int|null
     */
    private $max;


    /**
     * Repeat constructor.
     * @param OperatorInterface $operatorToRepeat
     * @param int $min
     * @param $max
     */
    public function __construct(OperatorInterface $operatorToRepeat, int $min = 0, $max = INF)
    {
        $this->operatorToRepeat = $operatorToRepeat;
        $this->min = $min;
        $this->max = $max;
    }

    public function find(Parser $parser, $input, $offset)
    {
        $_offset = $offset;
        $matches = [];
        $matchLen = 0;
        $inputLen = strlen($input);

        $i = 0;
        while (++$i <= $this->max) {
            $result = $parser->parseOperator($this->operatorToRepeat, $input, $offset);

            $offset = $result->newOffset();
            if (!$result->isMatch() || $offset > $inputLen) {
                if ($i <= $this->min) {
                    return Result::noMatch($_offset);
                }

                break;
            }
            $matches[] = $result->value();
            $matchLen += $result->length();
        }

        return empty($matches) ? Result::noMatch($_offset) : Result::match($matchLen, $matches, $_offset);
    }
}