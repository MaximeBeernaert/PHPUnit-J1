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
            if(!filter_var($a, FILTER_VALIDATE_EMAIL)) {
                $this->expectException(InvalidArgumentException::class);
                $this->expectExceptionMessage('Email must be a valid email address');
            }
            $result = $emailValidator->isValid($a);
        }
        $this->assertTrue($expected, $result);
    }
    
    public function emailValidatorDataProvider() {
        return [
            ['isValid', 'maximebeernaert@gmail.com', true],
            ['isValid', 'maximebeernaert gmail.com', false],
            ['isValid', '', false],
            ['isValid', 'maxime@gmail.', false],
            ['isValid', 'maximebeernaert123!**@gmail.com', true],
            ['isValid', 'maximebeernaer t123!**@gmail.com', true],

        ];
    }
}


?>