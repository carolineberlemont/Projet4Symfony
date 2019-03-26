<?php

namespace App\Service;



class ServiceStripe {
			
	// private $entityManager;

	// public function __construct(EntityManagerInterface $entityManager){
	// 	$this->entityManager = $entityManager;
	// }

	public function payment($price, $name)
	{
		\Stripe\Stripe::setApiKey("sk_test_5rsvvXwQzTQCwO0TMlvLCujq");

            try {
                $token = $_POST['stripeToken'];
                $charge = \Stripe\Charge::create([
                'amount' => $price*100,
                'currency' => 'eur',
                'description' => $name,
                'source' => $token,
                ]);
                return "success";
            } 
            catch(\Stripe\Error\Card $e) {
                // Since it's a decline, \Stripe\Error\Card will be caught
                $message = $e->getMessage();
                return $message;
            } 
        }
}	
	
	