<?php

declare(strict_types=1);

namespace Gavrila\TravelTickets;

class Ticket implements TicketInterface
{
    public const TYPE_BUS = 'bus';
    public const TYPE_BOAT = 'boat';
    public const TYPE_TAXI = 'taxi';
    public const TYPE_TRAM = 'tram';
    public const TYPE_TRAIN = 'train';
    public const TYPE_AIRPLANE = 'airplane';

    private string $type;
    private string $code;
    private string $seat;
    private string $description;
    private Station $origin;
    private Station $destination;

    public function __construct(
        string $type,
        string $code,
        Station $origin,
        Station $destination,
        string $seat = '',
        string $description = ''
    ) {
        $this->type = $type;
        $this->code = $code;
        $this->seat = $seat;
        $this->description = $description;
        $this->origin = $origin;
        $this->destination = $destination;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getSeat(): string
    {
        return $this->seat;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getOrigin(): Station
    {
        return $this->origin;
    }

    public function getDestination(): Station
    {
        return $this->destination;
    }
}