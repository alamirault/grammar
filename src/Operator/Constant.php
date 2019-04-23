<?php
/**
 * Created by PhpStorm.
 * User: alamirault
 * Date: 21/04/19
 * Time: 16:27
 */

namespace Alamirault\Grammar\Operator;


use Alamirault\Grammar\Parser;
use Alamirault\Grammar\Result;

class Constant implements OperatorInterface
{
    /**
     * @var string
     */
    private $literal;


    /**
     * Literal constructor.
     * @param string $literal
     */
    public function __construct(string $literal)
    {
        $this->literal = $literal;
    }

    public function find(Parser $parser, $input, $offset)
    {
        if (substr($input, $offset, strlen($this->literal)) === $this->literal) {
            return Result::match(strlen($this->literal), $this->literal, $offset);
        }

        return Result::noMatch($offset);
    }
}