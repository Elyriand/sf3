<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Domain;

class Candidate
{
    private $firstName;
    private $lastName;
    private $dateOfBirth;
    private $yearOfEntry;

    public function __construct(string $firstName, string $lastName, DateOfBirth $dateOfBirth, int $yearOfEntry)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->dateOfBirth = $dateOfBirth;
        $this->yearOfEntry = $yearOfEntry;
    }

    public function getYearOfEntry(): int
    {
        return $this->yearOfEntry;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getDateOfBirth(): DateOfBirth
    {
        return $this->dateOfBirth;
    }
}
