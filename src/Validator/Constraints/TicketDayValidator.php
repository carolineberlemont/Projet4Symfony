<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class TicketDayValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        //ici, $value correspondt à $ticket
        //on recupère la date d'aujourd'hui et l'heure
        $todayDate = new \DateTime();
        // on ne garde que l'heure
        $time = $todayDate->format('H');        
        // on rectifie l'heure au bon fuseau horaire
        $time += 1;

        //on récupère la date de visite-> 
        $visitdate = $value->getBooking()->getVisitdate();
        
        //on recupère le champ ticketprice remplis dans le formulaire->
        $ticketprice = $value->getTicketprice(); 

        if ( $time > 13 
                && $visitdate 
                && $visitdate->format('Y-m-d') == $todayDate->format('Y-m-d') 
                && $value->getTicketprice() == true) {
            $this->context->buildViolation($constraint->message)
                        ->atPath('ticketprice')
                        ->addViolation();
                }
        
    }
}