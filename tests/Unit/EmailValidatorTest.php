<?php
use PHPUnit\Framework\TestCase;
require_once 'src/EmailValidator.php';

class EmailValidatorTest extends TestCase
{
    /**
     * @dataProvider emailValidatorDataProvider
     */
 
    public function testEmailValidatorOperations($operation, $a, $expected) {
        $emailValidator = new EmailValidator();
        if($operation == 'isValid') {
            $result = $emailValidator->isValid($a);
        }
        $this->assertEquals($expected, $result);
    }
    
    public function emailValidatorDataProvider() {
        return [
            ['isValid', 'maximebeernaert@gmail.com', true],
            ['isValid', 'maximebeernaert gmail.com', false],
            ['isValid', '', false],
            ['isValid', 'maxime@gmail.', false],
            ['isValid', 'maximebeernaert123!**@gmail.com', true]
        ];
    }
}


?>