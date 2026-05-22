<?php

require_once __DIR__ . '/database/DBConnect.php';
require_once __DIR__ . '/model/Contact.php';
require_once __DIR__ . '/model/ContactManager.php';
require_once __DIR__ . '/commands/Command.php';

$dbConnect = new DBConnect();
$pdo       = $dbConnect->getPDO();

$contactManager = new ContactManager($pdo);
$commandHandler = new Command($contactManager);

echo "Gestionnaire de contacts" . PHP_EOL;
echo "Commandes disponibles :" . PHP_EOL;
echo "- list" . PHP_EOL;
echo "- detail id" . PHP_EOL;
echo "- create name,email,phone_number" . PHP_EOL;
echo "- delete id" . PHP_EOL;
echo "- exit" . PHP_EOL;

while (true) {
    echo "> ";

    $userInput = trim(fgets(STDIN));

    if ($userInput === 'list') {
        $commandHandler->list();
        continue;
    }

    if (preg_match('/^detail\s+([0-9]+)$/', $userInput, $matches)) {
        $id = (int) $matches[1];

        $commandHandler->detail($id);
        continue;
    }

    if (preg_match('/^create\s+([^,]+),([^,]+),([^,]+)$/', $userInput, $matches)) {
        $name        = trim($matches[1]);
        $email       = trim($matches[2]);
        $phoneNumber = trim($matches[3]);

        $commandHandler->create($name, $email, $phoneNumber);
        continue;
    }

    if (preg_match('/^delete\s+([0-9]+)$/', $userInput, $matches)) {
        $id = (int) $matches[1];

        $commandHandler->delete($id);
        continue;
    }

    if ($userInput === 'exit') {
        echo "Fermeture du programme." . PHP_EOL;
        break;
    }

    echo "Commande inconnue." . PHP_EOL;
}
