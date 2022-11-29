<?php

namespace App\Repository;

use App\Entity\Serie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Serie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Serie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Serie[]    findAll()
 * @method Serie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SerieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Serie::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Serie $entity, bool $flush = true): void
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
    public function remove(Serie $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return Serie[] Returns an array of Serie objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Serie
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    /**
     * Renvoi un tableau de séries en random avec leurs saisons.
     * Par défaut retourne la saison 1
     * Si nbLimit = 0, on retourne toutes les séries.
     * @param int $nbLimit
     * @param int $numSaison
     * @return float|int|mixed|string
     */
    public function findAllByRandWithSaison(int $nbLimit = 0, int $numSaison = 1)
    {
        if($nbLimit!=0){
            return $this->createQueryBuilder('s')

                ->setMaxResults($nbLimit)
                ->select('s, saison')
                ->join('s.saisons','saison' )
                ->where('saison.numero = :numSaison')
                ->setParameter('numSaison', $numSaison)
                ->orderBy('RAND()')
                ->getQuery()
                ->getResult();

        } else {
            return $this->createQueryBuilder('s')
                ->orderBy(RAND())
                ->select('s, saison')
                ->join('s.saisons','saison' )
                ->where('saison.numero = :numSaison')
                ->setParameter('numSaison', $numSaison)
                ->orderBy('RAND()')
                ->getQuery()
                ->getResult();
        }
    }

    public function findAllWithSaison(int $numSaison =1)
    {
        return $this->createQueryBuilder('s')
            ->addSelect('s, saison')
            ->join('s.saisons', 'saison')
            ->where('saison.numero = :numSaison')
            ->setParameter('numSaison', $numSaison)
            ->getQuery()
            ->getResult();
    }

    public function findByCategorieWithSaison(string $categorie)
    {
        return $this->createQueryBuilder('s')
            ->addSelect('s, saison')
            ->join('s.categories', 'c')
            ->join('s.saisons', 'saison')
            ->andWhere('c.categorie = :cat')
            ->andWhere('saison.numero = :numSaison')
            ->setParameter('numSaison', 1)
            ->orderBy('s.titre', 'ASC')
            ->setParameter('cat', $categorie)
            ->getQuery()
            ->getResult();
    }

    public function findOneByIdWithSaison(int $id, int $saison=1){
        return $this->createQueryBuilder('s')
            ->addSelect('s, saison')
            ->join('s.saisons', 'saison')
            ->andWhere('s.id = :id')
            ->andWhere('saison.numero = :numSaison')
            ->setParameter('numSaison', $saison)
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
