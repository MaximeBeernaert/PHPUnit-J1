<?php

class PasswordManager
{
    public function isValid($password)
    {        
        if(!preg_match('@[A-Z]@', $password)){
            throw new InvalidArgumentException('Password must contain at least 1 capital letter');
            return false;

        }else if(!preg_match('@[a-z]@', $password)){
            throw new InvalidArgumentException('Password must contain at least 1 lowercase letter');
            return false;

        }else if(!preg_match('@[0-9]@', $password)){
            throw new InvalidArgumentException('Password must contain at least 1 number');
            return false;

        }else if (strlen($password) < 8){
            throw new InvalidArgumentException('Password must be at least 8 characters long');
            return false;

        }else if (strlen($password) > 20){
            throw new InvalidArgumentException('Password must be at most 20 characters long');
            return false;

        }else if (preg_match('/\s/', $password)){
            throw new InvalidArgumentException('Password must not contain any whitespace');
            return false;

        }else if (preg_match('/[^A-Za-z0-9]/', $password)){
            throw new InvalidArgumentException('Password must not contain any special characters');
            return false;

        }else if (preg_match('/(.)\1{2,}/', $password)){
            throw new InvalidArgumentException('Password must not contain any sequence of 3 identical characters');
            return false;
        }
        return true;
    }
}

?>