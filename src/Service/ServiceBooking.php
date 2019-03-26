<?php

namespace App\Service;

use DateTime;
use DateInterval;
use App\Entity\Ticket;
use App\Entity\Booking;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\DependencyInjection\ContainerBuilder;


class ServiceBooking {
			
	private $entityManager;

	public function __construct(EntityManagerInterface $entityManager){
		$this->entityManager = $entityManager;
	}

	public function create(Booking $booking){
		$this->update($booking);
		$this->entityManager->persist($booking);		
		$this->entityManager->flush();		
	}

	public function CalculAge(Ticket $ticket)
	// on recupère les dates et on calcule l'âge du visiteur
	{
		$datetime1 = $ticket->getBirthdate();
		$datetime2 = new DateTime('now');
		$age = $datetime1->diff($datetime2);
		return $age->format('%y');
	}

	public function CalculPriceTicket(Ticket $ticket)
	// on récupère l'age du visiteur et on calcule le prix de son billet
	{
		$age = $this->CalculAge($ticket);
		$ticketprice = $ticket->getTicketprice();
		$reducedprice = $ticket->getReducedprice();
		
				if ($age < 4) {	
					$priceTicket = 0;
				}					
				elseif ($age > 3 & $age < 12) {
					if ($ticketprice == false) {
						$priceTicket = 4;
					}
					else {
						$priceTicket = 8;
					}
					
				}					
				elseif ($age > 59) {
					if ($ticketprice == false) {
						$priceTicket = 6;
					}
					elseif ( $reducedprice == true) {
						$priceTicket = 10;
					}	
					else {
						$priceTicket = 12;
					}
				}
					
				else {
					if ($ticketprice == false) {
						$priceTicket = 8;
					}
					elseif ( $reducedprice == true) {
						$priceTicket = 10;
					}	
					else {
						$priceTicket = 16;
					}
				}
		
		return $priceTicket;		
	}

	public function BookingNumber()
	// on crée un numéro de réservation aléatoire
	{
		$chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $bookingnumber = '';
    for($i=0; $i<8; $i++){
      $bookingnumber .= $chars[rand(0, strlen($chars)-1)];
    }
    return $bookingnumber;
	}

	public function update(Booking $booking): Booking 		
	{
		//on recupère le prix de chaque billet et on les ajoute pour avoir le prix total de la commande
		$tickets = $booking->getTickets();
		$total = 0;

		foreach($tickets as $ticket)
		{
			$oneprice = $this->CalculpriceTicket($ticket);
			// $ticket->setPrice($oneprice); si on a besoin du prix par ticket
			// ajouter le prix de chaque ticket il faut persister et flush les tickets
			$total = $total + $oneprice;
		}
		$booking->setTotalPrice($total);

		// on crée le numéro de commande aléatoire
		$bookingnumber = $this->BookingNumber();
		$booking->setBookingnumber($bookingnumber);

		return $booking;
	}
}	
	
	