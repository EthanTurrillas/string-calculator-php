<?php

declare(strict_types=1);

namespace Deg540\StringCalculatorPHP\Test;

use Deg540\StringCalculatorPHP\StringCalculator;
use PHPUnit\Framework\TestCase;

final class StringCalculatorTest extends TestCase
{
    /**
     * @test
     */
    public function noNumberGivenReturn0(){
        $stringCalculator = new StringCalculator();
        $result = $stringCalculator->intAdd("");
        $this->assertEquals(0, $result);
    }

    /**
     * @test
     */
    public function givenSingleNumberReturnSameNumber(){
        $stringCalculator = new StringCalculator();
        $result = $stringCalculator->intAdd("1");
        $this->assertEquals(1, $result);
    }

    /**
     * @test
     */
    public function given2NumbersReturnAdd(){
        $stringCalculator = new StringCalculator();
        $result = $stringCalculator->intAdd("1,2");
        $this->assertEquals(3, $result);
    }

    /**
     * @test
     */
    public function given135Return9(){
        $stringCalculator = new StringCalculator();
        $result = $stringCalculator->intAdd("1,3,5");
        $this->assertEquals(9, $result);
    }

    /**
     * @test
     */
    public function given123WithBrakeLineReturn6(){
        $stringCalculator = new StringCalculator();
        $result = $stringCalculator->intAdd("1\n2,3");
        $this->assertEquals(6, $result);
    }

    /**
     * @test
     */
    public function givenNewDelimiterReturnAdd()
    {
        $stringCalculator = new StringCalculator();
        $result = $stringCalculator->intAdd("//;\n1;2");
        $this->assertEquals(3, $result);
    }

    /**
     * @test
     */
    public function givenNegativeNumberReturnError()
    {
        $stringCalculator = new StringCalculator();
        $result = $stringCalculator->intAdd("-1");
        $this->assertEquals("Negativos no soportados: -1", $result);
    }
}