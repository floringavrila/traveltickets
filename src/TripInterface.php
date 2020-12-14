<?php

declare(strict_types=1);

namespace Gavrila\TravelTickets;

interface TripInterface
{
    public function getOrigin():Station;
    public function getDestination():Station;
}