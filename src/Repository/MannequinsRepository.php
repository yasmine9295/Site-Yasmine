<?php

namespace App\Repository;

use App\Entity\Mannequins;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;

/**
 * @extends ServiceEntityRepository<Mannequins>
 *
 * @method Mannequins|null find($id, $lockMode = null, $lockVersion = null)
 * @method Mannequins|null findOneBy(array $criteria, array $orderBy = null)
 * @method Mannequins[]    findAll()
 * @method Mannequins[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MannequinsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Mannequins::class);
    }

    /**
     * Récupère les mannequins dont le nom commence par une lettre spécifiée
     *
     * @param string $search
     * @return Query
     */
    // public function findBySearchQuery(string $search)
    // {
    //     return $this->createQueryBuilder('m')
    //         ->where('m.Nom LIKE :search')
    //         ->setParameter('search', $search . '%')  
    //         ->orderBy('m.Nom', 'ASC')  
    //         ->getQuery();
    // }

    /**
     * Retourne tous les mannequins triés par nom
     *
     * @return Query
     */
    public function findAllQuery()
    {
        return $this->createQueryBuilder('m')
            ->orderBy('m.Nom', 'ASC')
            ->getQuery();
    }

    /**
     * Retourne la liste complète des mannequins avec pagination
     *
     * @return Query
     */
    public function listeMannequinsCompletePaginee(?string $nom = "", ?int $specialisationId = null)
    {
        $qb = $this->createQueryBuilder('m')
                   ->leftJoin('m.specialisation', 's') // Jointure avec Specialisation
                   ->select('m', 's');
    
        // Filtrage par nom
        if ($nom) {
            $qb->andWhere('m.Nom LIKE :search')
               ->setParameter('search', $nom . '%');
        }
    
        // Filtrage par spécialisation
        if ($specialisationId) {
            $qb->andWhere('s.id = :specialisation')
               ->setParameter('specialisation', $specialisationId);
        }
    
        // Ordre des résultats
        $qb->orderBy('m.Nom', 'ASC')
           ->addOrderBy('s.nom', 'ASC');
    
        return $qb->getQuery();
    }



    public function findByDefile($defileId)
{
    return $this->createQueryBuilder('m')
        ->innerJoin('m.defiles', 'd') 
        ->where('d.id = :defileId')
        ->setParameter('defileId', $defileId)
        ->getQuery()
        ->getResult();
}

 /**
     * Recherche des mannequins par spécialisation
     *
     * @param int $specialisationId
     * @return Query
     */
    public function findBySpecialisation($specialisationId)
    {
        return $this->createQueryBuilder('m')
            ->innerJoin('m.specialisation', 's')
            ->andWhere('s.id = :specialisationId')
            ->setParameter('specialisationId', $specialisationId)
            ->getQuery()
            ->getResult();
    }

    // Méthode supplémentaire si nécessaire pour d'autres requêtes
    // public function findOneBySomeField($value): ?Mannequins
    // {
    //     return $this->createQueryBuilder('m')
    //         ->andWhere('m.exampleField = :val')
    //         ->setParameter('val', $value)
    //         ->getQuery()
    //         ->getOneOrNullResult()
    //     ;
    // }
}
