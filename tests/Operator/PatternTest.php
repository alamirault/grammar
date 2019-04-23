<?php
/**
 * Created by PhpStorm.
 * User: alamirault
 * Date: 23/04/19
 * Time: 20:48
 */

namespace Alamirault\Grammar\Tests\Operator;


use Alamirault\Grammar\Definition;
use Alamirault\Grammar\Operator\Pattern;
use Alamirault\Grammar\Parser;
use PHPUnit\Framework\TestCase;

class PatternTest extends TestCase
{
    public function testPatternSimple()
    {
        $parser = new Parser([
            new Definition('Digit', new Pattern('[0-9]')),
        ]);
        $this->assertEquals('3', $parser->parse('Digit', '3')->value());
        $r = $parser->parse('Digit', '9');
        $this->assertEquals('9', $r->value());
        $this->assertEquals(1, $r->newOffset());
        $this->assertFalse($parser->parse('Digit', 'a')->isMatch());
    }

    public function testComplexPattern()
    {
        $parser = new Parser([
            new Definition('email', new Pattern('[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}')),
        ]);
        $this->assertTrue($parser->parse('email', 'alamirault@test.fr')->isMatch());
        $this->assertFalse($parser->parse('email', 'alamiraulttest.fr')->isMatch());
    }
}