<?php

namespace Myklon\BracketsChecker;

use Myklon\BracketsChecker\BracketsChecker;
use PHPUnit\Framework\TestCase;

class BracketsCheckerTest extends TestCase
{
    protected BracketsChecker $test;
    protected function setUp(): void
    {
        $this->test = new BracketsChecker();
    }
    public function testSimpleTrueCheck()
    {
        $this->assertTrue($this->test->check("()()()"));
        $this->assertTrue($this->test->check("(())"));
    }
    public function testSimpleFalseCheck()
    {
        $this->assertFalse($this->test->check(")("));
        $this->assertFalse($this->test->check("(()"));
    }
    public function testTrueCheck()
    {
        $this->assertTrue($this->test->check("5 * (4 - 2)"));
        $this->assertTrue($this->test->check("{[()]}"));
        $this->assertTrue($this->test->check("T{E[S(T)I]N}G"));
    }
    public function testFalseCheck()
    {
        $this->assertFalse($this->test->check("5 * )4 - 2)"));
        $this->assertFalse($this->test->check("{[({)}]}"));
        $this->assertFalse($this->test->check("[S(T)I]N}G"));
    }
    public function testEmptyString()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->test->check("");

    }
    public function testWrongSymbols()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->test->check("123abc");
    }
}
