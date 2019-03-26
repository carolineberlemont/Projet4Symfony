<?php

namespace App\Tests\Service;

use App\Entity\Ticket;
use PHPUnit\Framework\TestCase;
use App\Service\ServiceBooking; 

class ServiceBookingTest extends TestCase 
{
   public function testCalulPrixDuTicketPourMoinsDe3A( )
    {
        $ticket = new Ticket();
        $ticket->setBirthdate('2019-02-21'); 
        $ticket->setReducedprice(false);
        $ticket->setTicketprice(false);
        $servicebooking = new ServiceBooking();
        $result = $servicebooking->CalculTicketPrice($ticket); 
        $this->assertEquals(0, $result); // prix du ticket attendu = 0
    }

    public function testCalulPrixDuTicketPour4Aa11ADemiejournée( )
    {
        $ticket = new Ticket();
        $ticket->setBirthdate('2011-02-21'); 
        $ticket->setReducedprice(false);
        $ticket->setTicketprice(true);
        $servicebooking = new ServiceBooking();
        $result = $servicebooking->CalculTicketPrice($ticket); 
        $this->assertEquals(4, $result); // prix du ticket attendu = 4
    }

    public function testCalulPrixDuTicketPour12Aa59ATarifréduit( )
    {
        $ticket = new Ticket();
        $ticket->setBirthdate('1980-02-21'); 
        $ticket->setReducedprice(true);
        $ticket->setTicketprice(false);
        $servicebooking = new ServiceBooking();
        $result = $servicebooking->CalculTicketPrice($ticket); 
        $this->assertEquals(10, $result); // prix du ticket attendu = 10
    }

    public function testCalulPrixDuTicketPour12Aa59A( )
    {
        $ticket = new Ticket();
        $ticket->setBirthdate('1980-02-21'); 
        $ticket->setReducedprice(false);
        $ticket->setTicketprice(false);
        $servicebooking = new ServiceBooking();
        $result = $servicebooking->CalculTicketPrice($ticket); 
        $this->assertEquals(16, $result); // prix du ticket attendu = 16
    }

    public function testCalulPrixDuTicketPlus60( )
    {
        $ticket = new Ticket();
        $ticket->setBirthdate('1940-02-21'); 
        $ticket->setReducedprice(true);
        $ticket->setTicketprice(true);
        $servicebooking = new ServiceBooking();
        $result = $servicebooking->CalculTicketPrice($ticket); 
        $this->assertEquals(6, $result); // prix du ticket attendu = 6
    }
}