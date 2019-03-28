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
        $ticket->setBirthdate(new \DateTime('21-02-2019')); 
        $ticket->setReducedprice(false);
        $ticket->setTicketprice(false);
        $servicebooking = new ServiceBooking();
        $result = $servicebooking->CalculTicketPrice($ticket); 
        $this->assertEquals(0, $result); // prix du ticket attendu = 0
    }

    public function testCalulPrixDuTicketPour4Aa11ADemiejournée( )
    {
        $ticket = new Ticket();
        $ticket->setBirthdate(new \DateTime('21-02-2011')); 
        $ticket->setReducedprice(false);
        $ticket->setTicketprice(true);
        $servicebooking = new ServiceBooking();
        $result = $servicebooking->CalculTicketPrice($ticket); 
        $this->assertEquals(4, $result); // prix du ticket attendu = 4
    }

    public function testCalulPrixDuTicketPour12Aa59ATarifréduit( )
    {
        $ticket = new Ticket();
        $ticket->setBirthdate(new \DateTime('21-02-1980')); 
        $ticket->setReducedprice(true);
        $ticket->setTicketprice(false);
        $servicebooking = new ServiceBooking();
        $result = $servicebooking->CalculTicketPrice($ticket); 
        $this->assertEquals(10, $result); // prix du ticket attendu = 10
    }

    public function testCalulPrixDuTicketPour12Aa59A( )
    {
        $ticket = new Ticket();
        $ticket->setBirthdate(new \DateTime('21-02-1980')); 
        $ticket->setReducedprice(false);
        $ticket->setTicketprice(false);
        $servicebooking = new ServiceBooking();
        $result = $servicebooking->CalculTicketPrice($ticket); 
        $this->assertEquals(16, $result); // prix du ticket attendu = 16
    }

    public function testCalulPrixDuTicketPlus60( )
    {
        $ticket = new Ticket();
        $ticket->setBirthdate(new \DateTime('21-02-1940')); 
        $ticket->setReducedprice(true);
        $ticket->setTicketprice(true);
        $servicebooking = new ServiceBooking();
        $result = $servicebooking->CalculTicketPrice($ticket); 
        $this->assertEquals(6, $result); // prix du ticket attendu = 6
    }
}