<?php

require_once __DIR__ . '/../model/ContactManager.php';

class Command
{
  private ContactManager $contactManager;

  public function __construct(ContactManager $contactManager)
  {
    $this->contactManager = $contactManager;
  }

  public function list(): void
  {
    $contacts = $this->contactManager->findAll();

    if (empty($contacts)) {
      echo "Aucun contact trouvé." . PHP_EOL;
      return;
    }

    foreach ($contacts as $contact) {
      echo $contact->toString();
    }
  }

  public function detail(int $id): void
  {
    $contact = $this->contactManager->findById($id);

    if ($contact === null) {
      echo "Aucun contact trouvé avec l'ID : " . $id . PHP_EOL;
      return;
    }

    echo $contact->toString();
  }

  public function create(string $name, string $email, string $phoneNumber): void
  {
    $contact = new Contact(
      null,
      $name,
      $email,
      $phoneNumber
    );

    $this->contactManager->create($contact);

    echo "Contact créé avec succès." . PHP_EOL;
  }

  public function delete(int $id): void
  {
    $contact = $this->contactManager->findById($id);

    if ($contact === null) {
      echo "Aucun contact trouvé avec l'ID : " . $id . PHP_EOL;
      return;
    }

    $this->contactManager->delete($id);

    echo "Contact supprimé avec succès." . PHP_EOL;
  }
}
