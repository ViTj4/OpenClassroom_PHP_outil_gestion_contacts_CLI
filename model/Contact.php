<?php

class Contact
{
    public function __construct(
        private ?int $id = null,
        private ?string $name = null,
        private ?string $email = null,
        private ?string $phoneNumber = null
    ) {}

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?string $phoneNumber): void
    {
        $this->phoneNumber = $phoneNumber;
    }

    public function toString(): string
    {
        return
            "ID : " . $this->id . PHP_EOL .
            "Nom : " . $this->name . PHP_EOL .
            "Email : " . $this->email . PHP_EOL .
            "Téléphone : " . $this->phoneNumber . PHP_EOL .
            "------------------------" . PHP_EOL;
    }
}
