<?php

use PHPUnit\Framework\TestCase;
require_once('./src/StatisticsCalculator.php');

class StatisticsCalculatorTest extends TestCase 
{
    /**
     * @dataProvider statisticsCalculatorDataProvider
     */
    public function testStatisticsCalculator($operation, $a, $expected) {
        $statisticsCalculator = new StatisticsCalculator();

        if(empty($a)) {
            $this->expectException(InvalidArgumentException::class);
            $this->expectExceptionMessage('Empty array');
        }

        if($operation == 'mean') {

            $result = $statisticsCalculator->mean($a);

        } elseif($operation == 'median') {

            $result = $statisticsCalculator->median($a);

        }

        $this->assertEquals($expected, $result);
    }
    
    public function statisticsCalculatorDataProvider() {
        return [
            ['mean', [8,10], 9],
            ['mean', [], false],

            ['median', [11,14], 12.5],
            ['median', [], false],

        ] ;
    }
}


?>