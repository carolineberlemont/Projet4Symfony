<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use App\Validator\Constraints as MyAssert;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TicketRepository")
 * @MyAssert\TicketDay
 */
class Ticket
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(min=2, exactMessage="Votre nom doit contenir au moins deux lettres")
     */
    private $name;
    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Votre prénom doit être renseigné")
     * @Assert\Length(min=2, exactMessage="Votre prénom doit contenir au moins deux lettres")
     */
    private $firstname;
    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank(message="Votre date de naissance doit être renseigné")
     * @Assert\Date 
     */
    private $birthdate;
    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Country
     */
    private $country;
    /**
     * @ORM\Column(type="boolean")
     */
    private $reducedprice;
    /**
     * @ORM\Column(type="boolean")
     */
    private $ticketprice;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Booking", inversedBy="tickets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $booking;
    public function getId(): ?int
    {
        return $this->id;
    }
    public function getName(): ?string
    {
        return $this->name;
    }
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }
    public function getFirstname(): ?string
    {
        return $this->firstname;
    }
    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;
        return $this;
    }
    public function getBirthdate(): ?\DateTime
    {
        return $this->birthdate;
    }
    public function setBirthdate(\DateTime $birthdate=null): self
    {
        $this->birthdate = $birthdate;
        return $this;
    }
    public function getCountry(): ?string
    {
        return $this->country;
    }
    public function setCountry(string $country): self
    {
        $this->country = $country;
        return $this;
    }
    public function getReducedprice(): ?bool
    {
        return $this->reducedprice;
    }
    public function setReducedprice(bool $reducedprice): self
    {
        $this->reducedprice = $reducedprice;
        return $this;
    }
    public function getTicketprice()
    {
        return $this->ticketprice;
    }
    public function setTicketprice($ticketprice): self
    {
        $this->ticketprice = $ticketprice;
        return $this;
    }
    public function getBooking(): ?Booking
    {
        return $this->booking;
    }
    public function setBooking(?Booking $booking): self
    {
        $this->booking = $booking;
        return $this;
    }
}

$ticket = new Ticket();
$propertyAccessor = PropertyAccess::createPropertyAccessorBuilder()
    ->enableMagicCall()
    ->getPropertyAccessor();
$propertyAccessor->setValue($ticket, 'ticketPrice', 'ticketPrice');
