<?php

declare(strict_types=1);

namespace Gavrila\TravelTickets\Sorting;

use Gavrila\TravelTickets\Collection\TicketCollection;

interface SortingInterface
{
    public function sort(TicketCollection $collection): TicketCollection;
}