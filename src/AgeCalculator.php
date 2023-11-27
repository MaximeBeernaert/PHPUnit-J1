<?php

class AgeCalculator
{
    public function calculateAge($birthDate)
    {
        $now = new DateTime();

        if (!is_string($birthDate)) {
            throw new InvalidArgumentException('Birthdate must be a valid date');
        }else if (!is_numeric(strtotime($birthDate))) {
            throw new InvalidArgumentException('Birthdate must be a valid date');
        }else if( checkdate(date('m', strtotime($birthDate)), date('d', strtotime($birthDate)), date('Y', strtotime($birthDate))) ) { 
            $birthDate = new DateTime($birthDate);
        }
        
        if( $birthDate > $now ) {
            throw new InvalidArgumentException('Birthdate cannot be greater than today');
        }

        $interval = $now->diff($birthDate);

        // pour les tests, on retourne l'age en années
        return $interval->format('%y');
    }
}


?>