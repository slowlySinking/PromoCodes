<?php

declare(strict_types=1);

namespace App\Entity;

class User extends Entity
{
    protected const TABLE_NAME = 'user';

    private int $id;
    private string $login;
    private string $email;
    private string $password;
    private ?int $promoCodeId = null;

    public function getId(): int
    {
        return $this->id;
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getPromoCodeId(): ?int
    {
        return $this->promoCodeId;
    }

    public function setPromoCodeId(?int $promoCodeId): self
    {
        $this->promoCodeId = $promoCodeId;

        return $this;
    }
}
