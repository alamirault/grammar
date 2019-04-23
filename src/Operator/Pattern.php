<?php
/**
 * Created by PhpStorm.
 * User: alamirault
 * Date: 21/04/19
 * Time: 16:04
 */

namespace Alamirault\Grammar\Operator;


use Alamirault\Grammar\Parser;
use Alamirault\Grammar\Result;

class Pattern implements OperatorInterface
{
    /**
     * @var string
     */
    private $regex;


    /**
     * Character constructor.
     * @param string $regex
     */
    public function __construct(string $regex)
    {
        $this->regex = $regex;
    }

    public function find(Parser $parser, $input, $offset){

        if (preg_match('{' . $this->regex . '}', substr($input, $offset), $match)) {
            return Result::match(1, $match[0], $offset);
        }

        return Result::noMatch($offset);
    }
}