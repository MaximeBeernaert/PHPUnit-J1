<?php

class TemperatureConverter
{
    public function convertToFahrenheit($temp)
    {
        if(!is_numeric($temp)) {
            throw new InvalidArgumentException('Temperature must be a number');
        }else if($temp < -273.15) {
            throw new InvalidArgumentException('Temperature must be above absolute zero');
        }
        return (floor($temp * 9/5) + 32);
    }

    public function convertToCelsius($temp)
    {
        if(!is_numeric($temp)) {
            throw new InvalidArgumentException('Temperature must be a number');
        }else if($temp < -459.67) {
            throw new InvalidArgumentException('Temperature must be above absolute zero');
        }
        return (floor($temp - 32) * 5/9);
    }
}

?>