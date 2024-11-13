<?php

namespace App\Repository;

use App\Entity\ImageVetement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ImageVetement>
 *
 * @method ImageVetement|null find($id, $lockMode = null, $lockVersion = null)
 * @method ImageVetement|null findOneBy(array $criteria, array $orderBy = null)
 * @method ImageVetement[]    findAll()
 * @method ImageVetement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImageVetementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ImageVetement::class);
    }

//    /**
//     * @return ImageVetement[] Returns an array of ImageVetement objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('i.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ImageVetement
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
