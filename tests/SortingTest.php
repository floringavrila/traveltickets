<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Gavrila\TravelTickets;

final class SortingTest extends TestCase
{
    public function testCanBeCreatedFromValidEmailAddress(): void
    {
        $sorter = new Gavrila\TravelTickets\Service();
        $tickets = $sorter->sortTickets($this->getShuffledTickets());

        $expected = [
            'RJX 765' => 1,
            'S5' => 2,
            'AA904' => 3,
            'ICN 35780' => 4,
            'airport bus' => 5,
            'AF1229' => 6,
            'AF136' => 7,
        ];

        $order = 1;
        foreach ($tickets->getTickets() as $ticket) {
            $this->assertArrayHasKey($ticket->getCode(), $expected);
            $this->assertEquals($expected[$ticket->getCode()], $order);

            $order++;
        }
    }


    private function getShuffledTickets(): TravelTickets\Collection\TicketCollection
    {
        $ticketsArray[] =
            new Gavrila\TravelTickets\Ticket(
                TravelTickets\Ticket::TYPE_TRAIN,
                'RJX 765',
                new Gavrila\TravelTickets\Station(
                    'St. Anton am Arlberg Bahnhof',
                    'St. Anton',
                    'Platform 3'
                ),
                new Gavrila\TravelTickets\Station(
                    'Innsbruck Hbf.',
                    'Innsbruck',
                ),
                '17C'
            );
        $ticketsArray[] = new Gavrila\TravelTickets\Ticket(
            TravelTickets\Ticket::TYPE_TRAM,
            'S5',
            new Gavrila\TravelTickets\Station(
                'Innsbruck Hbf.',
                'Innsbruck',

            ),
            new Gavrila\TravelTickets\Station(
                'Innsbruck Airport',
                'Innsbruck'
            )
        );
        $ticketsArray[] = new Gavrila\TravelTickets\Ticket(
            TravelTickets\Ticket::TYPE_AIRPLANE,
            'AA904',
            new Gavrila\TravelTickets\Station(
                'Innsbruck Airport',
                'Innsbruck',
                'gate 10'
            ),
            new Gavrila\TravelTickets\Station(
                'Venice Airport',
                'Venice'
            ),
            '18B',
            'Self-check-in luggage at counter.'
        );
        $ticketsArray[] = new Gavrila\TravelTickets\Ticket(
            TravelTickets\Ticket::TYPE_TRAIN,
            'ICN 35780',
            new Gavrila\TravelTickets\Station(
                'Gara Venetia Santa Lucia',
                'Venice',
                'Platform 1'
            ),
            new Gavrila\TravelTickets\Station(
                'Bologna San Ruffillo',
                'Bologna'
            ),
            '13F'
        );
        $ticketsArray[] = new Gavrila\TravelTickets\Ticket(
            TravelTickets\Ticket::TYPE_BUS,
            'airport bus',
            new Gavrila\TravelTickets\Station(
                'Bologna San Ruffillo',
                'Bologna'
            ),
            new Gavrila\TravelTickets\Station(
                'Bologna Guglielmo Marconi Airport',
                'Bologna'
            )
        );
        $ticketsArray[] = new Gavrila\TravelTickets\Ticket(
            TravelTickets\Ticket::TYPE_AIRPLANE,
            'AF1229',
            new Gavrila\TravelTickets\Station(
                'Bologna Guglielmo Marconi Airport',
                'Bologna',
                'gate 22'
            ),
            new Gavrila\TravelTickets\Station(
                'Paris CDG Airport',
                'Paris'
            ),
            '10A',
            'Self-check-in luggage at counter',
        );
        $ticketsArray[] = new Gavrila\TravelTickets\Ticket(
            TravelTickets\Ticket::TYPE_AIRPLANE,
            'AF136',
            new Gavrila\TravelTickets\Station(
                'Paris CDG Airport',
                'Paris',
                'gate 32'
            ),
            new Gavrila\TravelTickets\Station(
                'Chicago O\'Hare',
                'Chicago'
            ),
            '10A',
            'Luggage will transfer automatically from the last flight.',
        );

        shuffle($ticketsArray);
        $tickets = new TravelTickets\Collection\TicketCollection();
        foreach ($ticketsArray as $item) {
            $tickets->addTicket($item);
        }

        return $tickets;
    }
}

