<?php

use PHPUnit\Framework\TestCase;

require_once('./src/StringManipulator.php');


class StringManipulatorTest extends TestCase {

    /**
     * @dataProvider stringManipulatorDataProvider
     */
    public function testStringManipulator($operation, $str1, $str2, $expected) {
        $stringManipulator = new StringManipulator();
        if(!is_string($str1) || !is_string($str2)) {
            $this->expectException(InvalidArgumentException::class);
            $this->expectExceptionMessage('Invalid argument');
        }
        if($operation == 'concatenate') {
            $result = $stringManipulator->concatenate($str1, $str2);
        } elseif($operation == 'capitalize') {
            $result = $stringManipulator->capitalize($str1);
        } elseif($operation == 'reverse') {
            $result = $stringManipulator->reverse($str1);
        } elseif($operation == 'length') {
            $result = $stringManipulator->length($str1);
        } elseif($operation == 'contains') {
            if($str1 == '' || $str2 == ''){
                $this->expectException(InvalidArgumentException::class);
                $this->expectExceptionMessage('Empty string');
            }
            $result = $stringManipulator->contains($str1, $str2);
        }
        $this->assertEquals($expected, $result);
    }
    
    public function stringManipulatorDataProvider() {
        return [
            ['concatenate', 'Hello', 'World', 'HelloWorld'],
            ['concatenate', 'maxime', 'beernaert', 'maximebeernaert'],
            ['concatenate', 'Hello', ' World', 'Hello World'],
            ['concatenate', 'Hello', '', 'Hello'],
            ['concatenate', '', '', ''],

            ['capitalize', 'hello', '', 'Hello'],
            ['capitalize', 'maxime', '', 'Maxime'],
            ['capitalize', 'mAXIME', '', 'Maxime'],
            ['capitalize', ' ', '', ' '],
            ['capitalize', 'a', '', 'A'],

            ['reverse', 'Hello', '', 'olleH'],
            ['reverse', 'MAXIME', '', 'EMIXAM'],    
            ['reverse', ' ', '', ' '],
            ['reverse', 'a', '', 'a'],

            ['length', 'Hello', '', 5],
            ['length', 'Maxime BEERNAERT', '', 16],
            ['length', ' ', '', 1],

            ['contains', 'Hello', 'llo', true],
            ['contains', 'Maxime', 'max', false],
            ['contains', 'Maxime', 'Loris', false],
            ['contains', 'Maxime BEERNAERT', ' ', true],
            ['contains', '', '', false],
        ];
    }

}

?>