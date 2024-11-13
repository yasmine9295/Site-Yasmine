<?php

namespace App\Repository;

use App\Entity\ImageMannequin;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ImageMannequin>
 *
 * @method ImageMannequin|null find($id, $lockMode = null, $lockVersion = null)
 * @method ImageMannequin|null findOneBy(array $criteria, array $orderBy = null)
 * @method ImageMannequin[]    findAll()
 * @method ImageMannequin[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImageMannequinRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ImageMannequin::class);
    }

//    /**
//     * @return ImageMannequin[] Returns an array of ImageMannequin objects
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

//    public function findOneBySomeField($value): ?ImageMannequin
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
