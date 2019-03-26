<?php

namespace App\Repository;

use App\Entity\Booking;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Booking|null find($id, $lockMode = null, $lockVersion = null)
 * @method Booking|null findOneBy(array $criteria, array $orderBy = null)
 * @method Booking[]    findAll()
 * @method Booking[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookingRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Booking::class);
    }

    public function countByDay($date)
    //fonction qui compte le nombre de ticket pour un jour donné
    {
        return $this->createQueryBuilder('b')
            ->innerJoin('b.tickets', 't', "WITH", "b.visitdate = :currentDate")    
            ->setParameter('currentDate', $date)
            ->select('COUNT(t)')
            ->getQuery()
            ->getSingleScalarResult();
    }

    // public function lastBooking()
    // {
    //     return $this->createQueryBuilder('b')
    //         ->orderBy('b.id', 'DESC')
    //         ->setMaxResults(1)
    //         ->getQuery()
    //     ;
    // }
    

    /*
    public function findOneBySomeField($value): ?Booking
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
