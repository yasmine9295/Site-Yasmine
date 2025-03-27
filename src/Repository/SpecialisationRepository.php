<?php

namespace App\Repository;

use App\Entity\Specialisation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<NomSpecialisation>
 *
 * @method Specialisation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Specialisation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Specialisation[]    findAll()
 * @method Specialisation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SpecialisationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Specialisation::class);
    }


     /**
     * Retourne tous les mannequins triés par nom
     *
     * @return Query
     */
    public function findAllQuery()
    {
        return $this->createQueryBuilder('s')
            ->orderBy('s.nom', 'ASC')
            ->getQuery();
    }

//    /**
//     * @return NomSpecialisation[] Returns an array of NomSpecialisation objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('n.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?NomSpecialisation
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
