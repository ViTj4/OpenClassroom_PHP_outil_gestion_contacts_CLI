<?php

require_once __DIR__ . '/Contact.php';
class ContactManager
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function findAll(): array
    {
        $request = $this->pdo->query('SELECT id, name, email, phone_number FROM contact');

        $contactsData = $request->fetchAll();
        $contacts     = [];

        foreach ($contactsData as $contactData) {
            $contacts[] = new Contact(
                (int) $contactData['id'],
                $contactData['name'],
                $contactData['email'],
                $contactData['phone_number']
            );
        }

        return $contacts;
    }
}
