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
    public function testCheck()
    {

        $this->assertSame(true, $this->test->check("()()()"));
    }
    public function testCheck2()
    {
        $this->assertTrue($this->test->check("()()"), "QWWRWRWR");
    }
}
