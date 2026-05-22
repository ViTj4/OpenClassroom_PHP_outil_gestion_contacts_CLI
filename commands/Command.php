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
}
