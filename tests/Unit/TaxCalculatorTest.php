<?php

use PHPUnit\Framework\TestCase;
require_once 'src/TaxCalculator.php';

class TaxCalculatortest extends TestCase 
{
    /**
     * @dataProvider taxCalculatorDataProvider
     */
    public function testTaxCalculator($operation, $a, $b, $expected) {
        $taxCalculator = new TaxCalculator();

        if($operation == 'calculateTax') {

            if($a == '' || $b == '') {
                $this->expectException(InvalidArgumentException::class);
                $this->expectExceptionMessage('Values cannot be empty');
            }else if($a <= 0 || $b <= 0) {
                $this->expectException(InvalidArgumentException::class);
                $this->expectExceptionMessage('Values cannot be negative or null');
            }else if($b >100){
                $this->expectException(InvalidArgumentException::class);
                $this->expectExceptionMessage('Tax rate cannot be greater than 100%');
            }

            $result = $taxCalculator->calculateTax($a, $b);
        }

        $this->assertEquals($expected, $result);
    }
    
    public function taxCalculatorDataProvider() {
        return [
            ['calculateTax', 100, 20, 20],
            ['calculateTax', 0, 1, false],
            ['calculateTax', 2, 0, false],
            ['calculateTax', 0, '', false],
            ['calculateTax', '', 0, false],
            ['calculateTax', 0, 120, false],
        ];
    }
}

?>