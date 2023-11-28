<?php

use PHPUnit\Framework\TestCase;

require_once('./src/TemperatureConverter.php');

class TemperatureConverterTest extends TestCase
{

    /**
     * @dataProvider temperatureConverterDataProvider
     */
    public function testTemperatureConverter($operation, $temperature, $expected)
    {
        $temperatureConverter = new TemperatureConverter();

        if($operation == 'convertCelsiusToFahrenheit') {

            if(!is_numeric($temperature)) {
                $this->expectException(InvalidArgumentException::class);
                $this->expectExceptionMessage('Temperature must be a number');
            }else if($temperature < -273.15) {
                $this->expectException(InvalidArgumentException::class);
                $this->expectExceptionMessage('Temperature must be above absolute zero');
            }

            $result = $temperatureConverter->convertToFahrenheit($temperature);

        } elseif($operation == 'convertFahrenheitToCelsius') {

            if(!is_numeric($temperature)) {
                $this->expectException(InvalidArgumentException::class);
                $this->expectExceptionMessage('Temperature must be a number');
            }else if($temperature < -459.67) {
                $this->expectException(InvalidArgumentException::class);
                $this->expectExceptionMessage('Temperature must be above absolute zero');
            }

            $result = $temperatureConverter->convertToCelsius($temperature);

        }
    }

    public function temperatureConverterDataProvider() {
        return [
            ['convertCelsiusToFahrenheit', 0, 32],
            ['convertCelsiusToFahrenheit', -280, false],
            ['convertCelsiusToFahrenheit', -480, false],
            ['convertCelsiusToFahrenheit', '', false],
            ['convertCelsiusToFahrenheit', 'a', false],
            ['convertCelsiusToFahrenheit', '0', false],

            ['convertFahrenheitToCelsius', 32, 0],
            ['convertFahrenheitToCelsius', -470, false],
            ['convertFahrenheitToCelsius', -280, false],
            ['convertFahrenheitToCelsius', '', false],
            ['convertFahrenheitToCelsius', 'a', false],
            ['convertFahrenheitToCelsius', '0', false],
        ];
    }
}

?>