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
  private function getAvailableCommands(): array
  {
    return [
      [
        'name'        => 'help',
        'description' => 'Affiche la liste des commandes disponibles.',
        'example'     => null
      ],
      [
        'name'        => 'list',
        'description' => 'Affiche la liste complète des contacts.',
        'example'     => null
      ],
      [
        'name'        => 'detail id',
        'description' => "Affiche le détail d'un contact à partir de son identifiant.",
        'example'     => 'detail 1'
      ],
      [
        'name'        => 'create name,email,phone_number',
        'description' => 'Crée un nouveau contact.',
        'example'     => 'create Jean Dupont,jean.dupont@example.com,0601020304'
      ],
      [
        'name'        => 'delete id',
        'description' => "Supprime un contact à partir de son identifiant.",
        'example'     => 'delete 1'
      ],
      [
        'name'        => 'exit',
        'description' => 'Ferme le programme.',
        'example'     => null
      ]
    ];
  }

  public function help(): void
  {
    echo "Commandes disponibles :" . PHP_EOL;

    foreach ($this->getAvailableCommands() as $command) {
      echo PHP_EOL;
      echo $command['name'] . PHP_EOL;
      echo "  " . $command['description'] . PHP_EOL;

      if ($command['example'] !== null) {
        echo "  Exemple : " . $command['example'] . PHP_EOL;
      }
    }
  }
}
