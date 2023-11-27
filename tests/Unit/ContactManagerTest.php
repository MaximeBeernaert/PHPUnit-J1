<?php

use PHPUnit\Framework\TestCase;

require_once('./src/ContactManager.php');

class ContactManagerTest extends TestCase
{
    public function testAddContact()
    {
        // Créez une instance de ContactManager
        $contactManager = new ContactManager();

        // Ajoutez un contact
        $contactManager->addContact('John Doe', '0123456789', 'john@example.com');

        // Récupérez la liste des contacts
        $contacts = $contactManager->getContacts();

        // Vérifiez que le contact a été ajouté
        $this->assertCount(1, $contacts);

        // Vérifiez que le contact ajouté a les bonnes informations
        $this->assertEquals('John Doe', $contacts[0]['name']);
        $this->assertEquals('0123456789', $contacts[0]['phone']);
        $this->assertEquals('john@example.com', $contacts[0]['email']);
    }

    public function testRemoveContact()
    {
        // Créez une instance de ContactManager
        $contactManager = new ContactManager();

        // Ajoutez deux contacts
        $contactManager->addContact('Alice', '9876543210', 'alice@example.com');
        $contactManager->addContact('Bob', '0978563412', 'bob@example.com');

        // Supprimez un contact
        $contactManager->removeContact('Alice');

        // Récupérez la liste des contacts après suppression
        $contacts = $contactManager->getContacts();

        // Vérifiez que le contact a été supprimé
        $this->assertCount(1, $contacts);

        // Vérifiez que le contact restant est celui attendu
        $this->assertEquals('Bob', $contacts[0]['name']);
        $this->assertEquals('0978563412', $contacts[0]['phone']);
        $this->assertEquals('bob@example.com', $contacts[0]['email']);
    }
}
