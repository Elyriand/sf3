<?php
/**
 * @author Boris Guéry <guery.b@gmail.com>
 */

namespace Tiquette\Domain;

interface TicketRepository
{
    public function save(Ticket $ticket): void;

    /** @return Ticket[] */
    public function findAll(): array;

    /** @return Ticket[] */
    public function findById(String $id): array;
}
