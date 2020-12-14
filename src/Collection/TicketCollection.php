<?php

declare(strict_types=1);

namespace Gavrila\TravelTickets\Collection;

use Gavrila\TravelTickets\TicketInterface;

class TicketCollection
{
    /**
     * @var TicketInterface[]
     */
    private array $tickets;

    public function addTicket(TicketInterface $ticket): void
    {
        $this->tickets[] = $ticket;
    }

    /**
     * @return TicketInterface[]
     */
    public function getTickets(): array
    {
        return $this->tickets ?? [];
    }
}