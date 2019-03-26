<?php
namespace App\Form;
use App\Entity\Booking;
use App\Form\TicketType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\OptionsResolver\OptionsResolver;
class BookingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', null, array('label' => 'Votre adresse email'))
            ->add('visitdate', DateType::class, array('label' => 'Votre jour de visite', 'widget' => 'single_text', 'attr' => ['class' => 'js-pickadate-booking']))
            ->add('tickets', CollectionType::class, [
            'entry_type' => TicketType::class,
            // 'label' => false,
            'allow_add' => true,
            'by_reference' => false,
            'allow_delete' => true]);            
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Booking::class,            
            'cascade_validation' => true,
        ));
    }
}