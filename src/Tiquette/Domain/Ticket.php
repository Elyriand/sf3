<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Tiquette\Domain;

class Ticket
{
    private $eventName;
    private $eventDate;
    private $eventDescription;
    private $boughtAtPrice;

    public static function submit(string $eventName, \DateTimeImmutable $eventDate, string $eventDescription,
        int $boughtAtPrice): self
    {
        return new self($eventName, $eventDate, $eventDescription, $boughtAtPrice);
    }

    public function getEventName(): string
    {
        return $this->eventName;
    }

    public function getEventDate(): \DateTimeImmutable
    {
        return $this->eventDate;
    }

    public function getEventDescription(): string
    {
        return $this->eventDescription;
    }

    public function getBoughtAtPrice(): int
    {
        return $this->boughtAtPrice;
    }

    private function __construct(string $eventName, \DateTimeImmutable $eventDate, string $eventDescription, int $boughtAtPrice)
    {
        $this->eventName = $eventName;
        $this->eventDate = $eventDate;
        $this->eventDescription = $eventDescription;
        $this->boughtAtPrice = $boughtAtPrice;
    }
}
