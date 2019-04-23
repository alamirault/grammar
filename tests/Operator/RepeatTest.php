<?php
/**
 * Created by PhpStorm.
 * User: alamirault
 * Date: 23/04/19
 * Time: 21:02
 */

namespace Alamirault\Grammar\Tests\Operator;


use Alamirault\Grammar\Definition;
use Alamirault\Grammar\Operator\AndOperator;
use Alamirault\Grammar\Operator\Constant;
use Alamirault\Grammar\Operator\Repeat;
use Alamirault\Grammar\Parser;
use PHPUnit\Framework\TestCase;

class RepeatTest extends TestCase
{

    public function testRepeat()
    {
        $parser = new Parser([
            new Definition('Word', new Repeat(
                new Constant('a')
            )),
        ]);
        $this->assertEquals('a', $parser->parse('Word', 'a')->value());
        $this->assertEquals('aaaa', $parser->parse('Word', 'aaaa')->value());
        $r = $parser->parse('Word', 'aabc');
        $this->assertEquals('aa', $r->value());
        $this->assertEquals(2, $r->newOffset());
        $r = $parser->parse('Word', 'bcaa');
        $this->assertEquals('', $r->value());
        $this->assertEquals(0, $r->newOffset());
    }

    public function testRepeatWithMinAndMax()
    {
        $parser = new Parser([
            new Definition('Word', new Repeat(
                new Constant('a'), 2, 4
            )),
        ]);
        $this->assertFalse($parser->parse('Word', 'a')->isMatch());
        $this->assertEquals('aa', $parser->parse('Word', 'aa')->value());
        $r = $parser->parse('Word', 'aaa');
        $this->assertEquals('aaa', $r->value());
        $this->assertEquals(3, $r->newOffset());;
        $this->assertEquals('aaaa', $parser->parse('Word', 'aaaa')->value());
        $r = $parser->parse('Word', 'aaaaa');
        $this->assertEquals('aaaa', $r->value());
        $this->assertEquals(4, $r->newOffset());
    }

    public function testRepeatComplex()
    {
        $parser = new Parser([
            new Definition('Word', new Repeat(
                new AndOperator(
                    new Constant('a'),
                    new Constant('b')
                )
            )),
        ]);

        $this->assertFalse($parser->parse('Word', 'a')->isMatch());
    }
}