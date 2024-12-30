<?php

namespace App\Repository;

use App\Entity\Commentaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Commentaire>
 *
 * @method Commentaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method Commentaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method Commentaire[]    findAll()
 * @method Commentaire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentaireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Commentaire::class);
    }

    /**
     * Récupère les commentaires liés à un article donné
     * 
     * @param int $blogId L'identifiant de l'article
     * @return Commentaire[] Returns an array of Commentaire objects
     */
    public function findByBlog(int $blogId): array
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.blog = :blogId')
            ->setParameter('blogId', $blogId)
            ->orderBy('c.createdAt', 'DESC') // Tri par date de création décroissante
            ->getQuery()
            ->getResult();
    }

    /**
     * Récupère les derniers commentaires
     * 
     * @param int $limit Le nombre maximum de commentaires à retourner
     * @return Commentaire[] Returns an array of Commentaire objects
     */
    public function findLatest(int $limit): array
    {
        return $this->createQueryBuilder('c')
            ->orderBy('c.createdAt', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    /**
     * Trouve un commentaire spécifique par son contenu
     * 
     * @param string $value Le texte recherché dans le commentaire
     * @return Commentaire|null
     */
    public function findOneByContent(string $value): ?Commentaire
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.content LIKE :val')
            ->setParameter('val', '%' . $value . '%') // Recherche partielle
            ->getQuery()
            ->getOneOrNullResult();
    }
}
