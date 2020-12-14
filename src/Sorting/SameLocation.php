<?php

declare(strict_types=1);

namespace Gavrila\TravelTickets\Sorting;

use Gavrila\TravelTickets\Collection;

class SameLocation implements SortingInterface
{
    public function sort(Collection\TicketCollection $collection): Collection\TicketCollection
    {
        // bus , boat, taxi
        return $collection;
    }
}