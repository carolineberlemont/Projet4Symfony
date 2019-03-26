<?php

namespace App\Tests\Entity;

use App\Entity\Ticket; 
use PHPUnit\Framework\TestCase;

class TicketTest extends TestCase 
{
   public function testOfTicket()
   {
      $testt = new Ticket;

      $testt->setName('Dupont');
      $testt->setFirstname('Julio');
      $testt->setBirthdate('25/05/1982');
      $testt->setCountry('BE');
      $testt->setReducedprice(false);
      $testt->setTicketprice(false);
      $testt->setBooking('22');

      $this->assertEquals('Dupont', $testt->getName());
      $this->assertEquals('Julio', $testt->getFirstname());
      $this->assertEquals('25/05/1982', $testt->getBirthdate());
      $this->assertEquals('BE', $testt->getCountry());
      $this->assertFalse('', $testt->getReducedprice());
      $this->assertFalse('', $testt->getTicketprice());
      $this->assertEquals('22', $testt->getBooking());
   }       
}