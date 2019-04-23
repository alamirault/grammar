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

class Character implements OperatorInterface
{
    /**
     * @var string
     */
    private $regex;


    /**
     * Character constructor.
     */
    public function __construct(string $regex)
    {
        $this->regex = $regex;
    }

    public function find(Parser $parser, $input, $offset){
        $regex = '{^['.$this->regex.']}';

        if (preg_match($regex, substr($input, $offset), $match)) {
            return Result::match(1, $match[0], $offset);
        }

        return Result::noMatch($offset);
    }
}