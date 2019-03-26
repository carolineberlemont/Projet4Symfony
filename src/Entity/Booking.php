<?php
namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BookingRepository")
 */
class Booking
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $bookingnumber;
    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email(message="Votre email n'est pas valide")
     */
    private $email;
    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank(message="Votre date de visite doit être renseigné")
     * @Assert\Date
     */
    private $visitdate;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0)
     */
    private $totalprice;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ticket", mappedBy="booking", orphanRemoval=true, cascade = {"persist"})
     * @Assert\Valid
     */
    protected $tickets;

    public function __construct()
    {
        $this->tickets = new ArrayCollection();
    }
    public function getId(): ?int
    {
        return $this->id;
    }
    public function getBookingnumber(): ?string
    {
        return $this->bookingnumber;
    }
    public function setBookingnumber(string $bookingnumber): self
    {
        $this->bookingnumber = $bookingnumber;
        return $this;
    }
    public function getEmail(): ?string
    {
        return $this->email;
    }
    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }
    public function getVisitdate(): ?\DateTimeInterface
    {
        return $this->visitdate;
    }
    public function setVisitdate(\DateTime $visitdate=null): self
    {
        $this->visitdate = $visitdate;
        return $this;
    }
    public function getTotalprice()
    {
        return $this->totalprice;
    }
    public function setTotalprice($totalprice): self
    {
        $this->totalprice = $totalprice;
        return $this;
    }
    /**
     * @return Collection|Ticket[]
     */
    public function getTickets(): Collection
    {
        return $this->tickets;
    }
    public function addTicket(Ticket $ticket): self
    {
        if (!$this->tickets->contains($ticket)) {
            $this->tickets[] = $ticket;
            $ticket->setBooking($this);
        }
        return $this;
    }
    public function removeTicket(Ticket $ticket): self
    {
        if ($this->tickets->contains($ticket)) {
            $this->tickets->removeElement($ticket);
            if ($ticket->getBooking() === $this) {
                $ticket->setBooking(null);
            }
        }
        return $this;
    }
}
