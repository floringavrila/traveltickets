<?php

declare(strict_types=1);

namespace Gavrila\TravelTickets\Sorting;

use Gavrila\TravelTickets\Collection;

class OneWayTripSorter
{
    private SortingInterface $sortingStrategy;

    public function __construct(SortingInterface $sorting)
    {
        $this->sortingStrategy = $sorting;
    }

    public function sortTickets(Collection\TicketCollection $tickets): Collection\TicketCollection
    {
        $collection = new Collection\TicketCollection();
        foreach ($this->sortingStrategy->sort($tickets)->getTickets() as $order => $ticket) {
            $collection->addTicket($ticket);
        }

        return $collection;
    }
}