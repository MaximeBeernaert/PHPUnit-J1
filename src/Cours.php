<?php 

class Cours
{

    private $arrayCours = array();


    public function getCours()
    {
        return $this->arrayCours;
    }

    public function addCours($matiere, $professeurs, $salle)
    {
        if($matiere == '') {
            throw new InvalidArgumentException('Matiere cannot be empty');
        }
        if($professeurs == []) {
            throw new InvalidArgumentException('Professeurs cannot be empty');
        }
        if($salle == '') {
            throw new InvalidArgumentException('Salle cannot be empty');
        }

        foreach($professeurs as $key => $prof) {
            if($prof == '') {
                throw new InvalidArgumentException('Professeur cannot be empty');
            }else if(!is_string($prof) ) {
                throw new InvalidArgumentException('Professeur must be a string');
            }
        }
        if(!is_string($matiere) ) {
            throw new InvalidArgumentException('Matiere must be a string');
        }
        
        $cours = array();
        $cours['matiere'] = $matiere;
        $cours['professeurs'] = $professeurs;
        $cours['salle'] = $salle;

        array_push($this->arrayCours, $cours);
        return true;
    }

    public function removeCours($matiere)
    {
        $index = 0;
        if($matiere == '') {
            throw new InvalidArgumentException('Matiere cannot be empty');
        }
        if(!is_string($matiere) ) {
            throw new InvalidArgumentException('Matiere must be a string');
        }

        foreach ($this->arrayCours as $key => $cours) {
            if ($cours['matiere'] == $matiere) {
                array_splice($this->arrayCours, $key, 1);
                $index = 1;
                return true;
            }
        }
        if($index == 0){
            throw new OutOfRangeException('Matiere not in cours');
        }
    }

    public function searchProfesseur($professeur)
    {
        if($professeur == '') {
            throw new InvalidArgumentException('Professeur cannot be empty');
        }else if(!is_string($professeur) ) {
            throw new InvalidArgumentException('Professeur must be a string');
        }

        $coursProfesseur = array();
        foreach ($this->arrayCours as $key => $cours) {
            foreach ($cours['professeurs'] as $key => $prof) {
                if ($prof == $professeur) {
                    array_push($coursProfesseur, $cours);
                }
            }
        }
        if($coursProfesseur == []) {
            throw new OutOfRangeException('Professeur not in cours');
        }
        return $coursProfesseur;
    }

    public function modifySalleCours($matiere, $salle)
    {
        if($matiere == '') {
            throw new InvalidArgumentException('Matiere cannot be empty');
        }
        if($salle == '') {
            throw new InvalidArgumentException('Salle cannot be empty');
        }
        if(!is_string($matiere) ) {
            throw new InvalidArgumentException('Matiere must be a string');
        }

        foreach ($this->arrayCours as $key => $cours) {
            if ($cours['matiere'] == $matiere) {
                $this->arrayCours[$key]['salle'] = $salle;
                return true;
            }
        }
        throw new OutOfRangeException('Matiere not in cours');
    }

}


?>