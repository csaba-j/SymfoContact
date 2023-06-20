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
        $metadata->addPropertyConstraint('name', new Assert\NotBlank());
        $metadata->addPropertyConstraint('name', new Assert\Length([
            'min' => 3,
            'max' => 64,
            'minMessage' => 'Your name must be at least {{ limit }} characters long',
            'maxMessage' => 'Your name cannot be longer than {{ limit }} characters',
        ]));

        $metadata->addPropertyConstraint('email', new Assert\Email([
            'message' => 'The given e-mail address is not a valid address.',
        ]));
        $metadata->addPropertyConstraint('email', new Assert\NotBlank());
        $metadata->addPropertyConstraint('email', new Assert\Length([
            'max' => 64,
            'maxMessage' => 'Your name cannot be longer than {{ limit }} characters',
        ]));
        $metadata->addPropertyConstraint('message', new Assert\NotBlank());
        $metadata->addPropertyConstraint('message', new Assert\Length([
            'min' => 10,
            'max' => 255,
            'minMessage' => 'Your message must be at least {{ limit }} characters long',
            'maxMessage' => 'Your message cannot be longer than {{ limit }} characters',
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
