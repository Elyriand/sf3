<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Metinet\Domain;

class Student
{
    private $firstName;
    private $lastName;
    private $dateOfBirth;
    private $yearOfEntry;
    private $sponsor;

    public function __construct(string $firstName, string $lastName, DateOfBirth $dateOfBirth, int $yearOfEntry,
        ?Student $sponsor = null)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->dateOfBirth = $dateOfBirth;
        $this->yearOfEntry = $yearOfEntry;
        $this->sponsor = $sponsor;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getSeniority(): int
    {
        return (int) (new \DateTimeImmutable('now'))->format('Y') -  $this->yearOfEntry;
    }

    public function canSponsor(Candidate $candidate): bool
    {
        return ($candidate->getYearOfEntry() - $this->yearOfEntry) > 2;
    }

    public function sponsor(Candidate $candidate): self
    {
        if (!$this->canSponsor($candidate)) {

            throw UnableToSponsorCandidate::notEnoughSeniority($this, $candidate);
        }

        return new self(
            $candidate->getFirstName(),
            $candidate->getLastName(),
            $candidate->getDateOfBirth(),
            $candidate->getYearOfEntry(),
            $this
        );
    }

    public function getSponsor(): ?self
    {
        return $this->sponsor;
    }
}
