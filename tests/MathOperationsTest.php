<?php

use Engtuncay\Phputils8\Dep\MathOperations;
use PHPUnit\Framework\TestCase;

class MathOperationsTest extends TestCase {
  private $math;

  protected function setUp(): void {
    $this->math = new MathOperations();
  }

  public function testAdd() {
    $result = $this->math->add(2, 3);
    $this->assertEquals(5, $result);
  }

  public function testSubtract() {
    $result = $this->math->subtract(5, 3);
    $this->assertEquals(2, $result);
  }
}
