<?php

declare(strict_types=1);

namespace Gavrila\TravelTickets;

use Gavrila\TravelTickets\Collection;
use Gavrila\TravelTickets\Sorting;

class Service
{
    public function sortTickets(Collection\TicketCollection $tickets): Collection\TicketCollection
    {
        $ticketsInSameLocation = [];
        $betweenTickets = new Collection\TicketCollection();
        foreach ($tickets->getTickets() as $ticket) {
            if ($ticket->getOrigin()->getLocality() === $ticket->getDestination()->getLocality()) {
                $collection = $ticketsInSameLocation[$ticket->getOrigin()->getLocality()] ?? new Collection\TicketCollection();
                $collection->addTicket($ticket);
                $ticketsInSameLocation[$ticket->getOrigin()->getLocality()] = $collection;
                continue;
            }
            $betweenTickets->addTicket($ticket);
        }


        $allTickets = new Collection\TicketCollection();

        foreach (
            (new Sorting\OneWayTripSorter(new Sorting\BetweenLocation()))
                ->sortTickets($betweenTickets)->getTickets() as $ticket
        ) {
            $allTickets->addTicket($ticket);
            if (isset($ticketsInSameLocation[$ticket->getDestination()->getLocality()])) {
                foreach (
                    (new Sorting\OneWayTripSorter(new Sorting\SameLocation()))
                        ->sortTickets($ticketsInSameLocation[$ticket->getDestination()->getLocality()])
                        ->getTickets() as $t
                ) {
                    $allTickets->addTicket($t);
                }
            }
        }

        return $allTickets;
    }
}