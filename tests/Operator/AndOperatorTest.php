<?php
/**
 * Created by PhpStorm.
 * User: alamirault
 * Date: 23/04/19
 * Time: 21:12
 */

namespace Alamirault\Grammar\Tests\Operator;


use Alamirault\Grammar\Definition;
use Alamirault\Grammar\Operator\AndOperator;
use Alamirault\Grammar\Operator\Constant;
use Alamirault\Grammar\Parser;
use PHPUnit\Framework\TestCase;

class AndOperatorTest extends TestCase
{
    public function testSimple()
    {
        $parser = new Parser([
            new Definition('Word', new AndOperator(
                new Constant('a'),
                new Constant('b')
            )),
        ]);

        $this->assertFalse($parser->parse('Word', 'a')->isMatch());
        $this->assertTrue($parser->parse('Word', 'ab')->isMatch());
        $this->assertFalse($parser->parse('Word', 'ba')->isMatch());
    }
}