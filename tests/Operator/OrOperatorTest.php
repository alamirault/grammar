<?php
/**
 * Created by PhpStorm.
 * User: alamirault
 * Date: 23/04/19
 * Time: 20:39
 */

namespace Alamirault\Grammar\Tests\Operator;


use Alamirault\Grammar\Definition;
use Alamirault\Grammar\Operator\Constant;
use Alamirault\Grammar\Operator\OrOperator;
use Alamirault\Grammar\Parser;
use PHPUnit\Framework\TestCase;

class OrOperatorTest extends TestCase
{
    public function testWithTowConstant()
    {
        $floatMarker = new OrOperator(
            new Constant(','),
            new Constant('.')
        );

        $parser = new Parser([
            new Definition('floatMarker', $floatMarker),
        ]);

        $this->assertTrue($parser->parse('floatMarker', '.')->isMatch());
        $this->assertTrue($parser->parse('floatMarker', ',')->isMatch());
        $this->assertFalse($parser->parse('floatMarker', ';')->isMatch());
    }
}