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

    public function findById(int $id): ?Contact
    {
        $request = $this->pdo->prepare('SELECT id, name, email, phone_number FROM contact WHERE id = :id');

        $request->execute([
            'id' => $id
        ]);

        $contactData = $request->fetch();

        if ($contactData === false) {
            return null;
        }

        return new Contact(
            (int) $contactData['id'],
            $contactData['name'],
            $contactData['email'],
            $contactData['phone_number']
        );
    }

    public function create(Contact $contact): void
    {
        $request = $this->pdo->prepare(
            'INSERT INTO contact (name, email, phone_number) VALUES (:name, :email, :phone_number)'
        );

        $request->execute([
            'name'         => $contact->getName(),
            'email'        => $contact->getEmail(),
            'phone_number' => $contact->getPhoneNumber()
        ]);
    }

    public function delete(int $id): void
    {
        $request = $this->pdo->prepare('DELETE FROM contact WHERE id = :id');

        $request->execute([
            'id' => $id
        ]);
    }
}
