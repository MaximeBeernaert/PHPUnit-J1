<?php

use PHPUnit\Framework\TestCase;

require_once('./src/BookMAnager.php');

class BookManagerTest extends TestCase
{
    public function testAddBook()
    {
        // Créez une instance de BookManager
        $bookManager = new BookManager();

        // Ajoutez un livre
        $bookManager->addBook('Le Rouge et le Noir', 'Stendhal', 10.99);

        // Récupérez la liste des livres
        $books = $bookManager->getBooks();

        // Vérifiez que le livre a été ajouté
        $this->assertCount(1, $books);

        // Vérifiez que le livre ajouté a les bonnes informations
        $this->assertEquals('Le Rouge et le Noir', $books[0]['title']);
        $this->assertEquals('Stendhal', $books[0]['author']);
        $this->assertEquals(10.99, $books[0]['price']);
    }

    public function testRemoveBook()
    {
        // Créez une instance de BookManager
        $bookManager = new BookManager();

        // Ajoutez deux livres
        $bookManager->addBook('Le Malade imaginaire', 'Molière', 2.99);
        $bookManager->addBook('Harry Potter et le prisonnier d\'Azkaban ', 'J. K. Rowling ', 24.99);

        // Supprimez un livre
        $bookManager->removeBook('Le Malade imaginaire');

        // Récupérez la liste des livres après suppression
        $books = $bookManager->getBooks();

        // Vérifiez que le livre a été supprimé
        $this->assertCount(1, $books);

        // Vérifiez que le livre restant est celui attendu
        $this->assertEquals('Harry Potter et le prisonnier d\'Azkaban ', $books[0]['title']);
        $this->assertEquals('J. K. Rowling ', $books[0]['author']);
        $this->assertEquals(24.99, $books[0]['price']);
    }
}
