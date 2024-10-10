<?php

class Technician {
    private string $firstName;
    private string $lastName;
    private string $email;
    private string $phone;
    private string $password;
    private int $techID;

    // Constructor to initialize the properties
    public function __construct(int $techID, string $firstName, string $lastName, string $email, string $phone, string $password) {
        $this->techID = $techID;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->phone = $phone;
        $this->password = $password;
    }

    // Get the full name (firstName + lastName)
    public function getFullName(): string {
        return $this->firstName . ' ' . $this->lastName;
    }

    // Get the email
    public function getEmail(): string {
        return $this->email;
    }

    // Get the phone
    public function getPhone(): string {
        return $this->phone;
    }

    // Get the password
    public function getPassword(): string {
        return $this->password;
    }

    // Get the techID
    public function getTechID(): int {
        return $this->techID;
    }
}
?>