<?php

namespace App\Module\Survey;

class Survey 
{
    private ?string $firstName;
    private ?string $lastName;
    private ?string $email;
    private ?string $age;
    private ?string $avatar;

    public function __construct(?string $firstName, ?string $lastName, ?string $email, ?string $age, ?string $avatar)
    { 
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->age = $age;
        $this->avatar = $avatar;
    }

    public function getParameterFirstName(): ?string
    { 
        return $this->firstName;       
    }

    public function getParameterLastName(): ?string
    { 
        return $this->lastName;       
    }

    public function getParameterEmail(): ?string
    { 
        return $this->email;       
    }

    public function getParameterAge(): ?string
    { 
        return $this->age;       
    }

    public function getParameterAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setParameterFirstName(string $value): void
    {
        $this->firstName = $value;
    }

    public function setParameterLastName(string $value): void
    {
        $this->lastName = $value;
    }

    public function setParameterEmail(string $value): void
    {
        $this->email = $value;
    }

    public function setParameterAge(string $value): void
    {
        $this->age = $value;
    }

    public function setParameterAvatar(string $value): void
    {
        $this->avatar = $value;
    }
}