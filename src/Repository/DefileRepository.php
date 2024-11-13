<?php

namespace App\Repository;


use App\Entity\Defile;
use App\Repository\DefileRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;


/**
 * @extends ServiceEntityRepository<Artiste>
 *
 * @method Defile|null find($id, $lockMode = null, $lockVersion = null)
 * @method Defile|null findOneBy(array $criteria, array $orderBy = null)
 * @method Defile[]    findAll()
 * @method Defile[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DefileRepository extends ServiceEntityRepository
{
    public function __construct (ManagerRegistry $registry)
    {
        parent::__construct($registry, Defile::class);
    }

    public function listeDefilesComplete()
    {
        return $this->createQueryBuilder('def')
           ->select('def','a')
           ->leftJoin('def.albums','a')
           ->orderBy('def.nom','ASC')
           ->getQuery()
           ->getResult();
    }

    public function listeDefilesCompletePaginee()
    {
        return $this->createQueryBuilder('art')
           ->select('def','a')
           ->leftJoin('def.albums','a')
           ->orderBy('def.nom','ASC')
           ->getQuery()
           ->getResult();
    }
    public function add(Defile $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Defile $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function listeDefileSimple()
    {
        return $this->createQueryBuilder('art')
           ->orderBy('art.nom','ASC');
    }
}
