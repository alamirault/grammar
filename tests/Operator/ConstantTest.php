<?php
/**
 * Created by PhpStorm.
 * User: alamirault
 * Date: 23/04/19
 * Time: 20:25
 */

namespace Alamirault\Grammar\Tests\Operator;


use Alamirault\Grammar\Definition;
use Alamirault\Grammar\Operator\Constant;
use Alamirault\Grammar\Parser;
use PHPUnit\Framework\TestCase;

class ConstantTest extends TestCase
{
    public function testSimpleConstant()
    {
        $parser = new Parser([
            new Definition('Letter', new Constant('a')),
        ]);
        $r = $parser->parse('Letter', 'a');
        $this->assertEquals('a', $r->value());
        $this->assertEquals(1, $r->newOffset());
        $this->assertFalse($parser->parse('Letter', 'b')->isMatch());
    }

    public function testLongConstant()
    {
        $parser = new Parser([
            new Definition('keyword', new Constant('abcdef')),
        ]);
        $r = $parser->parse('keyword', 'abcdef');
        $this->assertEquals('abcdef', $r->value());
        $this->assertEquals(6, $r->newOffset());
        $this->assertFalse($parser->parse('keyword', 'b')->isMatch());
    }

    public function testConstantWithTwoDefinitions()
    {
        $parser = new Parser([
            new Definition('LetterA', new Constant('a')),
            new Definition('LetterB', new Constant('b')),
        ]);
        $r = $parser->parse('LetterA', 'a');
        $this->assertEquals('a', $r->value());
        $this->assertEquals(1, $r->newOffset());
        $this->assertFalse($parser->parse('LetterB', 'a')->isMatch());

        $this->assertFalse($parser->parse('LetterA', 'b')->isMatch());
    }
}