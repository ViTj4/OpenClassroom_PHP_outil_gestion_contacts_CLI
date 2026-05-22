<?php

function listContacts(ContactManager $contactManager): void
{
    $contacts = $contactManager->findAll();

    if (empty($contacts)) {
        echo "Aucun contact trouvé." . PHP_EOL;
        return;
    }

    foreach ($contacts as $contact) {
        echo $contact->toString();
    }
}