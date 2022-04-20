<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\NewsPosts;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method NewsPosts|null find($id, $lockMode = null, $lockVersion = null)
 * @method NewsPosts|null findOneBy(array $criteria, array $orderBy = null)
 * @method NewsPosts[] findAll()
 * @method NewsPosts[] findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NewsPostsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NewsPosts::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(NewsPosts $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(NewsPosts $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function resetUpvotes()
    {
        $conn = $this->getEntityManager()
            ->getConnection();
        $sql = 'UPDATE postgres.public.news_posts SET amount_of_upvotes = 0 WHERE 1 =1';
        $stmt = $conn->prepare($sql);
        $stmt->executeQuery();
    }

    // /**
    //  * @return NewsPosts[] Returns an array of NewsPosts objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?NewsPosts
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
