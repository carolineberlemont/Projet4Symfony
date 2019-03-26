<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class TicketDay extends Constraint
{
    public $message = "Vous ne pouvez acheter un billet journée pour aujourd\'hui apres 14h. Merci de choisir un billet demie-journée";
    
    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}