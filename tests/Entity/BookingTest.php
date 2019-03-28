<?php

namespace App\Tests\Entity;

use App\Entity\Booking; 
use PHPUnit\Framework\TestCase;

class BookingTest extends TestCase 
{
     public function testVisitDateIsInstanceOfDateTime()
     {
          $testb = new Booking;
          $this->assertInstanceOf(\DateTime::class, $testb->getVisitdate());
     }
   
     public function testOfBooking()
     {
          $testb = new Booking;
  
          $testb->setBookingnumber('1a2b3CE7');
          $testb->setEmail('emailtest@phpunit.fr');
          $testb->setVisitdate(new \DateTime('25-05-2019'));
          $testb->setTotalprice('32');
  
          $this->assertEquals('1a2b3CE7', $testb->getBookingnumber());
          $this->assertEquals('emailtest@phpunit.fr', $testb->getEmail());
          $this->assertEquals(new \DateTime('2019-05-25'), $testb->getVisitdate());
          $this->assertEquals('32', $testb->getTotalprice());
     }

   public function testIdBookingBigger0()
   {
        $testb = new Booking;
        $testb->setTotalprice('0');
        $this->assertGreaterThanOrEqual('0', $testb->getTotalprice());
   }
}