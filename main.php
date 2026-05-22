<?php

require_once __DIR__ . '/database/DBConnect.php';
require_once __DIR__ . '/model/Contact.php';
require_once __DIR__ . '/model/ContactManager.php';

$dbConnect = new DBConnect();
$pdo       = $dbConnect->getPDO();

echo "Gestionnaire de contacts" . PHP_EOL;
echo "Commandes disponibles : list, exit" . PHP_EOL;

while (true) {
    echo "> ";

    $command = trim(fgets(STDIN));

    if ($command === 'list') {
        $contactManager = new ContactManager($pdo);
        $contacts       = $contactManager->findAll();

        if (empty($contacts)) {
            echo "Aucun contact trouvé." . PHP_EOL;
            continue;
        }

        foreach ($contacts as $contact) {
            echo $contact->toString();
        }

        continue;
    }

    if ($command === 'exit') {
        echo "Fermeture du programme." . PHP_EOL;
        break;
    }

    echo "Commande inconnue." . PHP_EOL;
}
