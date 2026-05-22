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
echo "Commandes disponibles : list, exit" . PHP_EOL;

while (true) {
    echo "> ";

    $command = trim(fgets(STDIN));

    if ($command === 'list') {
        $commandHandler->list();
        continue;
    }

    if ($command === 'exit') {
        echo "Fermeture du programme." . PHP_EOL;
        break;
    }

    echo "Commande inconnue." . PHP_EOL;
}
