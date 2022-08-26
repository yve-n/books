<?php

namespace App\Repository;

use App\Entity\Book;
use App\Entity\Category;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Book>
 *
 * @method Book|null find($id, $lockMode = null, $lockVersion = null)
 * @method Book|null findOneBy(array $criteria, array $orderBy = null)
 * @method Book[]    findAll()
 * @method Book[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }

    public function add(Book $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Book $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findBookWithSameCategory(Category $category , int $id) : array
   {
    $entityManager = $this->getEntityManager();
    $query = $entityManager->createQuery(
        'SELECT b 
        FROM App\Entity\Book b
        WHERE b.category = :category
        AND b.id != :id
        ORDER BY b.id ASC'
    )->setParameter('category', $category)
     ->setParameter('id', $id);
      return $query->getResult();
    }

    public function findBookCategory(Category $category ) : array
   {
    $entityManager = $this->getEntityManager();
    $query = $entityManager->createQuery(
        'SELECT b 
        FROM App\Entity\Book b
        WHERE b.category = :category
        GROUP BY b.category'
    )->setParameter('category', $category);
      return $query->getResult();
    }
//    /**
//     * @return Book[] Returns an array of Book objects
//     */
   public function findBycategory(Category $category): array
   {
       return $this->createQueryBuilder('b')
           ->andWhere('b.category = :category')
           ->setParameter('category', $category)
           ->orderBy('b.id', 'ASC')
           ->getQuery()
           ->getResult()
       ;
   }

//    public function findOneBySomeField($value): ?Book
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
