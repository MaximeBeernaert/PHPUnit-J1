<?php

class StatisticsCalculator
{
    public function mean($numbers)
    {
        // Calcule la moyenne d'un tableau de nombres
        // Si le tableau est vide, retourne null

        if(empty($numbers)) {
            throw new InvalidArgumentException('Empty array');
        }

        $sum = 0;
        foreach($numbers as $number) {
            $sum += $number;
        }

        return $sum / count($numbers);
    }

    public function median($numbers)
    {
        // Calcule la médiane d'un tableau de nombres
        // Si le tableau est vide, retourne null

        if(empty($numbers)) {
            throw new InvalidArgumentException('Empty array');
        }

        sort($numbers);
        $middle = floor((count($numbers) - 1) / 2);

        if(count($numbers) % 2) {
            return $numbers[$middle];
        }else {
            return ($numbers[$middle] + $numbers[$middle + 1]) / 2;
        }


    }
}
