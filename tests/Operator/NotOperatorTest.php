<?php
/**
 * Created by PhpStorm.
 * User: alamirault
 * Date: 23/04/19
 * Time: 20:57
 */

namespace Alamirault\Grammar\Tests\Operator;


use Alamirault\Grammar\Definition;
use Alamirault\Grammar\Operator\Constant;
use Alamirault\Grammar\Operator\NotOperator;
use Alamirault\Grammar\Parser;
use PHPUnit\Framework\TestCase;

class NotOperatorTest extends TestCase
{
    public function testMatchReturnOpposite()
    {
        $parser = new Parser([
            new Definition('Letter', new NotOperator(
                new Constant('a')
            )),
        ]);

        $this->assertTrue($parser->parse('Letter', 'b')->isMatch());
        $this->assertFalse($parser->parse('Letter', 'a')->isMatch());
    }
}