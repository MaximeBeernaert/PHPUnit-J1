<?php

use PHPUnit\Framework\TestCase;
require_once 'src/PasswordManager.php';

class PasswordManagerTest extends TestCase 
{
    /**
     * @dataProvider passwordManagerDataProvider
     */
    public function testPasswordManager($operation, $a, $expected) {
        $passwordManager = new PasswordManager();

        if($operation == 'isValid') {

            if(!preg_match("#[A-Z]+#", $a)) {
                $this->expectException(InvalidArgumentException::class);
                $this->expectExceptionMessage('Password must contain at least 1 capital letter');
            }else if(!preg_match("#[a-z]+#", $a)) {
                $this->expectException(InvalidArgumentException::class);
                $this->expectExceptionMessage('Password must contain at least 1 lowercase letter');
            }else if(!preg_match("#[0-9]+#", $a)) {
                $this->expectException(InvalidArgumentException::class);
                $this->expectExceptionMessage('Password must contain at least 1 number');
            }else if(strlen($a) < 8) {
                $this->expectException(InvalidArgumentException::class);
                $this->expectExceptionMessage('Password must be at least 8 characters long');
            }else if (strlen($a) > 20) {
                $this->expectException(InvalidArgumentException::class);
                $this->expectExceptionMessage('Password must be at most 20 characters long');
            }else if (preg_match('/\s/', $a)) {
                $this->expectException(InvalidArgumentException::class);
                $this->expectExceptionMessage('Password must not contain any whitespace');
            }else if (preg_match('/[^A-Za-z0-9]/', $a)) {
                $this->expectException(InvalidArgumentException::class);
                $this->expectExceptionMessage('Password must not contain any special characters');
            }else if (preg_match('/(.)\1{2,}/', $a)) { 
                $this->expectException(InvalidArgumentException::class);
                $this->expectExceptionMessage('Password must not contain any sequence of 3 identical characters');
            }


            $result = $passwordManager->isValid($a);
        }

        $this->assertEquals($expected, $result);
    }
    
    public function passwordManagerDataProvider() {
        return [
            ['isValid', 'Maxime123!', true],
            ['isValid', 'Maxime123', true],
            ['isValid', 'maxime123!', false],
            ['isValid', 'MAXIME123!', false],
            ['isValid', 'maxime', false],
            ['isValid', 'MAXIME', false],
            ['isValid', 'mrt123!', false],
            ['isValid', 'mrt 123!', false],
            ['isValid', 'mrt12333333!', false],
            ['isValid', 'mrt1--23!', false],

        ];
    }
}

?>