<?php
/**
 * Created by PhpStorm.
 * User: alamirault
 * Date: 21/04/19
 * Time: 16:09
 */

namespace Alamirault\Grammar\Operator;


use Alamirault\Grammar\Parser;

interface OperatorInterface
{
    public function find(Parser $parser, $input, $offset);
}