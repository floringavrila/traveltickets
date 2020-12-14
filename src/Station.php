<?php

declare(strict_types=1);

namespace Gavrila\TravelTickets;

class Station
{
    private string $name;
    private string $locality;
    private string $description;

    public function __construct(
        string $name,
        string $locality,
        string $description = ''
    ) {
        $this->name = $name;
        $this->locality = $locality;
        $this->description = $description;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLocality(): string
    {
        return $this->locality;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
}
