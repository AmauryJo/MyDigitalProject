<?php

namespace App\Repository;

use App\Entity\Demandeur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Demandeur>
 *
 * @method Demandeur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Demandeur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Demandeur[]    findAll()
 * @method Demandeur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DemandeurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Demandeur::class);
    }

    //    /**
    //     * @return Demandeur[] Returns an array of Demandeur objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('d')
    //            ->andWhere('d.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('d.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

       public function findOneById($id): ?Demandeur
       {
           return $this->createQueryBuilder('d')
               ->andWhere('d.id = :id')
               ->setParameter('id', $id)
               ->getQuery()
               ->getOneOrNullResult()
           ;
       }

}
