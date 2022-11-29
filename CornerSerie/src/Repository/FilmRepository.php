<?php

namespace App\Repository;

use App\Entity\Film;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Film|null find($id, $lockMode = null, $lockVersion = null)
 * @method Film|null findOneBy(array $criteria, array $orderBy = null)
 * @method Film[]    findAll()
 * @method Film[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FilmRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Film::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Film $entity, bool $flush = true): void
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
    public function remove(Film $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * Retourne un tableau avec tous les films en random
     * Si nbLimit est != 0 alors on indique une limite, 0 est la valeur par défaut.
     * @param int $nbLimit
     * @return float|int|mixed|string
     */
    public function findAllbyRand(int $nbLimit = 0)
    {
        if ($nbLimit != 0) {
            return $this->createQueryBuilder('f')
                ->setMaxResults($nbLimit)
                ->orderBy("RAND()")
                ->getQuery()
                ->getResult();

        } else {
            return $this->createQueryBuilder('f')
                ->orderBy("RAND()")
                ->getQuery()
                ->getResult();
        }
    }

    public function findByCategorie(string $categorie)
    {
        return $this->createQueryBuilder('f')
            ->join('f.categories', 'c')
            ->andWhere('c.categorie = :cat')
            ->orderBy('f.titre', 'ASC')
            ->setParameter('cat', $categorie)
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return Film[] Returns an array of Film objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Film
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
