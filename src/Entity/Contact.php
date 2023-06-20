<?php

namespace App\Entity;

use App\Repository\ContactRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

#[ORM\Entity(repositoryClass: ContactRepository::class)]
class Contact
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 64)]
    private ?string $name = null;

    #[ORM\Column(length: 64)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $message = null;

    public static function loadValidatorMetadata(ClassMetadata $metadata): void
    {
        $metadata->addPropertyConstraint('name', new Assert\NotBlank(['message' => 'Hiba! Kérjük töltsd ki az összes mezőt!']));
        $metadata->addPropertyConstraint('name', new Assert\Length([
            'min' => 3,
            'max' => 64,
            'minMessage' => 'A nevednek legalább {{ limit }} karakter hosszúnak kell lennie.',
            'maxMessage' => 'A neved nem lehet hosszabb, mint {{ limit }} karakter.',
        ]));

        $metadata->addPropertyConstraint('email', new Assert\Email([
            'message' => 'A megadott e-mail cím nem valós e-mail cím!',
        ]));
        $metadata->addPropertyConstraint('email', new Assert\NotBlank(['message' => 'Hiba! Kérjük töltsd ki az összes mezőt!']));
        $metadata->addPropertyConstraint('email', new Assert\Length([
            'max' => 64,
            'maxMessage' => 'Az e-mail címed nem lehet hosszabb, mint {{ limit }} karakter.',
        ]));
        $metadata->addPropertyConstraint('message', new Assert\NotBlank(['message' => 'Hiba! Kérjük töltsd ki az összes mezőt!']));
        $metadata->addPropertyConstraint('message', new Assert\Length([
            'min' => 10,
            'max' => 255,
            'minMessage' => 'Az üzenetednek legalább {{ limit }} karakter hosszúnak kell lennie.',
            'maxMessage' => 'Az üzeneted nem lehet hosszabb, mint {{ limit }} karakter.',
        ]));
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): static
    {
        $this->message = $message;

        return $this;
    }
}
