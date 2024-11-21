<?php

namespace App\Repository;

use App\Entity\Defile;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Defile>
 *
 * @method Defile|null find($id, $lockMode = null, $lockVersion = null)
 * @method Defile|null findOneBy(array $criteria, array $orderBy = null)
 * @method Defile[]    findAll()
 * @method Defile[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DefileRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Defile::class);
    }
    
        /**
    * @return Query Returns an array of Artiste objects
     */
    public function listeDefilesCompletePaginee()
    {
        return $this->createQueryBuilder('d')
            ->select('d','m')
            ->leftJoin('d.marque','m')
            ->orderBy('d.NomD', 'ASC')         
            ->getQuery()
           
        ;
   
 }

//    /**
//     * @return Defile[] Returns an array of Defile objects
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

//    public function findOneBySomeField($value): ?Defile
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
