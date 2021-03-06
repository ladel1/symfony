<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Article>
 *
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    public function add(Article $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Article $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function joinArticleUtilisateur(){
        $em = $this->getEntityManager();
        $dql = "SELECT a FROM App\Entity\Article a";
        $query = $em->createQuery($dql);
        return $query->getResult();
    }


    public function findByName($name){
        $em = $this->getEntityManager();
        $dql  = "
            SELECT a FROM App\Entity\Article a
            WHERE a.name LIKE :name
        ";
        $query = $em->createQuery($dql);
        $query->setParameter("name","%$name%");
        return $query->getResult();
    }


    public function findByPrice($price,$op="eq"){
        $queryBuilder = $this->createQueryBuilder("a");
        if($op=="eq") $queryBuilder->andWhere("a.price = :price");  
        if($op=="gt") $queryBuilder->andWhere("a.price >= :price");   
        if($op=="lt") $queryBuilder->andWhere("a.price <= :price");        
        $query = $queryBuilder->getQuery();
        $query->setParameter("price",$price);
        return $query->getResult();
    }




//    /**
//     * @return Article[] Returns an array of Article objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Article
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
