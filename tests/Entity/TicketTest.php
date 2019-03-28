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
      $testt->setBirthdate(new \DateTime('29-03-2019'));
      $testt->setCountry('BE');
      $testt->setReducedprice(false);
      $testt->setTicketprice(false);

      $this->assertEquals('Dupont', $testt->getName());
      $this->assertEquals('Julio', $testt->getFirstname());
      $this->assertEquals((new \DateTime('29-03-2019')), $testt->getBirthdate());
      $this->assertEquals('BE', $testt->getCountry());
      $this->assertFalse('', $testt->getReducedprice());
      $this->assertFalse('', $testt->getTicketprice());
   }       
}