<?php

use PHPUnit\Framework\TestCase;

require_once 'src/AgeCalculator.php';

class AgeCalculatorTest extends TestCase 
{
    /**
     * @dataProvider ageCalculatorDataProvider
     */
    public function testAgeCalculator($operation, $a, $expected) {
        $ageCalculator = new AgeCalculator();

        if($operation == 'calculateAge') {
            $now = new DateTime();

            if (!is_string($a)) {
                $this->expectException(InvalidArgumentException::class);
                $this->expectExceptionMessage('Birthdate must be a valid date');

            }else if (!is_numeric(strtotime($a))) {
                $this->expectException(InvalidArgumentException::class);
                $this->expectExceptionMessage('Birthdate must be a valid date');

            }else if( checkdate(date('m', strtotime($a)), date('d', strtotime($a)), date('Y', strtotime($a))) ) { 
                $birthDate = new DateTime($a);
                if( $birthDate > $now ) {
                    $this->expectException(InvalidArgumentException::class);
                    $this->expectExceptionMessage('Birthdate cannot be greater than today');
                }
            }
            
            

            $result = $ageCalculator->calculateAge($a);
        }

        $this->assertEquals($expected, $result);
    }
    
    public function ageCalculatorDataProvider() {
        return [
            ['calculateAge', '27-01-2000',23],
            ['calculateAge', 43350, false],
            ['calculateAge', 'mauvaiseDate', false],
        ];
    }
}

?>