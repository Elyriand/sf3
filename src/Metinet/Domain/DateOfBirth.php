<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */
namespace Metinet\Domain;

class DateOfBirth
{
    private $dateOfBirth;

    public static function fromString(string $dateOfBirth): self
    {
        return new self($dateOfBirth);
    }

    public function toAge(): int
    {
        return (new \DateTimeImmutable('now'))->diff($this->dateOfBirth)->y;
    }

    private function __construct(string $dateOfBirth)
    {
        $dateOfBirthAsDateTime = \DateTimeImmutable::createFromFormat('Y-m-d H:i:s', sprintf('%s 23:59:59', $dateOfBirth));
        if ($dateOfBirthAsDateTime > new \DateTimeImmutable('now')) {

            throw InvalidDateOfBirth::mustNotBeInTheFuture();
        }

        $this->dateOfBirth = $dateOfBirthAsDateTime;
    }
}
