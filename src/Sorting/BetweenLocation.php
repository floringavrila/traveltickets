<?php

declare(strict_types=1);

namespace Gavrila\TravelTickets\Sorting;

use Gavrila\TravelTickets\Collection;
use Gavrila\TravelTickets\TicketInterface;

class BetweenLocation implements SortingInterface
{
    public function sort(Collection\TicketCollection $collection): Collection\TicketCollection
    {
        $mapBySource = [];
        $mapByDestination = [];
        foreach ($collection->getTickets() as $ticket) {
            $mapBySource[$ticket->getOrigin()->getLocality()] = $ticket;
            $mapByDestination[$ticket->getDestination()->getLocality()] = $ticket;
        }

        $out = new Collection\TicketCollection();
        $next = $this->getStartingTicket($mapBySource, $mapByDestination);

        $out->addTicket($next);
        while (true) {
            if (!isset($mapBySource[$next->getDestination()->getLocality()])) {
                break;
            }
            $next = $mapBySource[$next->getDestination()->getLocality()];
            $out->addTicket($next);
        }

        return $out;
    }

    /**
     * Search the start (the source that is not on destination).
     *
     * @param TicketInterface[] $mapBySource
     * @param TicketInterface[] $mapByDestination
     * @return TicketInterface
     */
    private function getStartingTicket(array $mapBySource, array $mapByDestination): TicketInterface
    {
        foreach ($mapBySource as $source => $ticket) {
            if (!isset($mapByDestination[$source])) {
                return $ticket;
            }
        }
    }
}