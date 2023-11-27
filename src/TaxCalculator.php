<?php

class TaxCalculator
{
    public function calculateTax($price, $tax)
    {
        if($price == '' || $tax == '') {
            throw new InvalidArgumentException('Values cannot be empty');
        }else if($price <= 0 || $tax <= 0) {
            throw new InvalidArgumentException('Values cannot be negative or null');
        }else if($tax >100){
            throw new InvalidArgumentException('Tax rate cannot be greater than 100%');
        }
        
        return $price * ($tax/100);
    }
}

?>