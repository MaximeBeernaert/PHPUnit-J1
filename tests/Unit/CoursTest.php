<?php

use PHPUnit\Framework\TestCase;

require_once('./src/Cours.php');

class CoursTest extends TestCase
{
    public function testAddCours()
    {
        // Créez une instance de Cours
        $cours = new Cours();

        // Ajoutez un cours
        $cours->addCours('Maths', ['Mme Dupont'], 'A1');

        // Récupérez la liste des cours
        $cours = $cours->getCours();

        // Vérifiez que le cours a été ajouté
        $this->assertCount(1, $cours);

        // Vérifiez que le cours ajouté a les bonnes informations
        $this->assertEquals('Maths', $cours[0]['matiere']);
        $this->assertEquals('Mme Dupont', $cours[0]['professeurs'][0]);
        $this->assertEquals('A1', $cours[0]['salle']);
    }

    public function testRemoveCours()
    {
        // Créez une instance de Cours
        $cours = new Cours();

        // Ajoutez deux cours
        $cours->addCours('Maths', ['Mme Dupont'], 'A1');
        $cours->addCours('Français', ['Mme Jean'], 'A2');

        // Supprimez un cours
        $cours->removeCours('Maths');

        // Récupérez la liste des cours après suppression
        $cours = $cours->getCours();

        // Vérifiez que le cours a été supprimé
        $this->assertCount(1, $cours);

        // Vérifiez que le cours restant est celui attendu
        $this->assertEquals('Français', $cours[0]['matiere']);
        $this->assertEquals('Mme Jean', $cours[0]['professeurs'][0]);
        $this->assertEquals('A2', $cours[0]['salle']);
    }

    public function testSearchProfesseur()
    {
        // Créez une instance de Cours
        $cours = new Cours();

        // Ajoutez trois cours
        $cours->addCours('Maths', ['Mme Dupont'], 'A1');
        $cours->addCours('Français', ['Mme Jean'], 'A2');
        $cours->addCours('Anglais', ['Mme Jean', 'Mme Dupont'], 'A3');

        // Récupérer les cours de Mme Jean
        $coursProfesseur = $cours->searchProfesseur('Mme Jean');

        // Vérifiez que les cours récupérés sont les bons
        $this->assertEquals('Français', $coursProfesseur[0]['matiere']);
        $this->assertEquals('Mme Jean', $coursProfesseur[0]['professeurs'][0]);
        $this->assertEquals('A2', $coursProfesseur[0]['salle']);

        $this->assertEquals('Anglais', $coursProfesseur[1]['matiere']);
        $this->assertEquals('Mme Jean', $coursProfesseur[1]['professeurs'][0]);
        $this->assertEquals('Mme Dupont', $coursProfesseur[1]['professeurs'][1]);
        $this->assertEquals('A3', $coursProfesseur[1]['salle']);
    }

    public function testModifySalleCours()
    {
        // Créez une instance de Cours
        $cours = new Cours();

        // Ajoutez deux cours
        $cours->addCours('Maths', ['Mme Dupont'], 'A1');
        $cours->addCours('Français', ['Mme Jean'], 'A2');

        // Modifiez la salle du cours de Maths
        $cours->modifySalleCours('Maths', 'A3');

        // Récupérez la liste des cours après modification
        $cours = $cours->getCours();

        // Vérifiez que le cours a été modifié
        $this->assertCount(2, $cours);

        // Vérifiez que le cours modifié est celui attendu
        $this->assertEquals('Maths', $cours[0]['matiere']);
        $this->assertEquals('Mme Dupont', $cours[0]['professeurs'][0]);
        $this->assertEquals('A3', $cours[0]['salle']);

        $this->assertEquals('Français', $cours[1]['matiere']);
        $this->assertEquals('Mme Jean', $cours[1]['professeurs'][0]);
        $this->assertEquals('A2', $cours[1]['salle']);
    }


    // EXCEPTIONS -----------------------------


    /**
     * @dataProvider exceptionsDataProvider
     */
    public function testExceptions($operation, $matiere, $professeurs, $salle, $expected)
    {
        $cours = new Cours();

        if($operation == 'addCours'){
            if($matiere == '') {
                $this->expectException(InvalidArgumentException::class);
                $this->expectExceptionMessage('Matiere cannot be empty');
            }
            if($professeurs == []) {
                $this->expectException(InvalidArgumentException::class);
                $this->expectExceptionMessage('Professeurs cannot be empty');
            }
            if($salle == '') {
                $this->expectException(InvalidArgumentException::class);
                $this->expectExceptionMessage('Salle cannot be empty');
            }
            foreach($professeurs as $key => $prof){
                if($prof == '') {
                    $this->expectException(InvalidArgumentException::class);
                    $this->expectExceptionMessage('Professeur cannot be empty');
                }else if(!is_string( $prof) ) {
                    $this->expectException(InvalidArgumentException::class);
                    $this->expectExceptionMessage('Professeur must be a string');
                }
            }

            if(!is_string( $matiere) ) {
                $this->expectException(InvalidArgumentException::class);
                $this->expectExceptionMessage('Matiere must be a string');
            }

            $result = $cours->addCours($matiere, $professeurs, $salle);

        }elseif($operation == 'removeCours'){

            $cours->addCours('Maths', ['Mme Dupont'], 'A1');
            $listeCours = $cours->getCours();
            $index = 0;

            foreach($listeCours as $key => $coursIndex) {
                if($coursIndex['matiere'] == $matiere) {
                    $index = 1;
                }
            }

            if($matiere == '') {
                $this->expectException(InvalidArgumentException::class);
                $this->expectExceptionMessage('Matiere cannot be empty');
            }else if(!is_string( $matiere) ) {
                $this->expectException(InvalidArgumentException::class);
                $this->expectExceptionMessage('Matiere must be a string');
            }else if($index == 0) {
                $this->expectException(OutOfRangeException::class);
                $this->expectExceptionMessage('Matiere not in cours');
            }

            $result = $cours->removeCours($matiere);

        }elseif($operation == 'searchProfesseur'){

            $cours->addCours('Maths', ['Mme Dupont'], 'A1');
            $cours->addCours('Français', ['Mme Jean'], 'A2');
            $cours->addCours('Anglais', ['Mme Jean', 'Mme Dupont'], 'A3');

            $listeCours = $cours->getCours();
            $coursProfesseur = [];

            foreach ($listeCours as $key => $coursIndex) {
                foreach ($coursIndex['professeurs'] as $key => $prof) {
                    if ($professeurs == $prof) {
                        array_push($coursProfesseur, $coursIndex);
                    }
                }
            }

            if($professeurs == '') {
                $this->expectException(InvalidArgumentException::class);
                $this->expectExceptionMessage('Professeur cannot be empty');
            }else if(!is_string( $professeurs) ) {
                $this->expectException(InvalidArgumentException::class);
                $this->expectExceptionMessage('Professeur must be a string');
            }else if($coursProfesseur == []) {
                $this->expectException(OutOfRangeException::class);
                $this->expectExceptionMessage('Professeur not found');
            }

            $result = $cours->searchProfesseur($professeurs);

        }elseif($operation == 'modifySalleCours'){
            
            $cours->addCours('Maths', ['Mme Dupont'], 'A1');
            $cours->addCours('Français', ['Mme Jean'], 'A2');
            $index = 0 ; 
            $listeCours = $cours->getCours();

            foreach ($listeCours as $key => $coursIndex) {
                if ($coursIndex['matiere'] == $matiere) {
                    $coursIndex['salle'] = $salle;
                    $index = 1;
                }
            }

            if($matiere == '') {
                $this->expectException(InvalidArgumentException::class);
                $this->expectExceptionMessage('Matiere cannot be empty');
            }else if($salle == '') {
                $this->expectException(InvalidArgumentException::class);
                $this->expectExceptionMessage('Salle cannot be empty');
            }else if(!is_string( $matiere) ) {
                $this->expectException(InvalidArgumentException::class);
                $this->expectExceptionMessage('Matiere must be a string');
            }else if($index == 0) {
                $this->expectException(OutOfRangeException::class);
                $this->expectExceptionMessage('Matiere not found');
            }

            $result = $cours->modifySalleCours($matiere, $salle);
        }

        $this->assertEquals($expected, $result);

    }

    public function exceptionsDataProvider() {
        return [
            ['addCours', '', ['Mme Dupont'], 'A1', false],
            ['addCours', 'Maths', [], 'A1', false],
            ['addCours', 'Maths', ['Mme Dupont'], '', false],
            ['addCours', 'Maths', ['Mme Dupont'], 'A1', true],

            ['removeCours', 'Maths', [], '', true],
            ['removeCours', '', [], '', false],
            ['removeCours', 'Français', [], '', false],

            ['searchProfesseur', '', '', '', false],
            ['searchProfesseur', '','Mme Dupont', '', [['matiere' => 'Maths', 'professeurs' => ['Mme Dupont'], 'salle' => 'A1'], ['matiere' => 'Anglais', 'professeurs' => ['Mme Jean', 'Mme Dupont'], 'salle' => 'A3']]],

            ['modifySalleCours', '', [], 'A1', false],
            ['modifySalleCours', 'Maths', [], '', false],
            ['modifySalleCours', 'Français', [], 'A1', true],

        ];
    }

}

?>