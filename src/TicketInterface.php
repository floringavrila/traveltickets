<?php

declare(strict_types=1);

namespace Gavrila\TravelTickets;

interface TicketInterface extends TripInterface
{
    public function getType(): string;
    public function getCode(): string;
    public function getSeat(): string;
    public function getDescription(): string;
}