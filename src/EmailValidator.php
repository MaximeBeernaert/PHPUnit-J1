<?php

class EmailValidator
{
    public function isValid($email)
    {
        // Vérifie si une adresse e-mail est valide
        // Utilise la fonction filter_var avec FILTER_VALIDATE_EMAIL

        if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }else {
            throw new InvalidArgumentException('Email must be a valid email address');
        }
    }
}
