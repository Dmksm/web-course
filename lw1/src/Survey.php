<?php
class Survey 
{
    private $firstName;
    private $lastName;
    private $email;
    private $age;

    public function __construct(?string $firstName, $lastName, $email, $age)
    { 
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->age = $age;
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

    public function setParameterFirstName(string $value)
    {
        $this->firstName = $value;
    }

    public function setParameterLastName(string $value)
    {
        $this->lastName = $value;
    }

    public function setParameterEmail(string $value)
    {
        $this->email = $value;
    }

    public function setParameterAge(string $value)
    {
        $this->age = $value;
    }
}