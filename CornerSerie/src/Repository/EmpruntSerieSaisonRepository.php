<?php

namespace App\Repository;

use App\Entity\EmpruntSerieSaison;
use App\Entity\Utilisateur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EmpruntSerieSaison|null find($id, $lockMode = null, $lockVersion = null)
 * @method EmpruntSerieSaison|null findOneBy(array $criteria, array $orderBy = null)
 * @method EmpruntSerieSaison[]    findAll()
 * @method EmpruntSerieSaison[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmpruntSerieSaisonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EmpruntSerieSaison::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(EmpruntSerieSaison $entity, bool $flush = true): void
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
    public function remove(EmpruntSerieSaison $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function findAllPastFomUser(int $utilisateur):mixed
    {
        $utilisateurID = $utilisateur;
        return $this->createQueryBuilder('e')
            ->select('e, saison, serie')
            ->join('e.saison', 'saison')
            ->join('saison.serie', 'serie')
            ->where('e.actif = 0')
            ->andWhere('e.utilisateur = :utilisateurID')
            ->setParameter('utilisateurID', $utilisateurID)
            ->getQuery()
            ->getResult();
    }

    public function findAllCurrentFomUser(int $utilisateur):mixed
    {
        $utilisateurID = $utilisateur;
        return $this->createQueryBuilder('e')
            ->select('e, saison, serie')
            ->join('e.saison', 'saison')
            ->join('saison.serie', 'serie')
            ->where('e.actif = 1')
            ->andWhere('e.utilisateur = :utilisateurID')
            ->setParameter('utilisateurID', $utilisateurID)
            ->getQuery()
            ->getResult();
    }

    public function findOneByIDAndUserID(int $id, int $userID): mixed
    {
        return $this->createQueryBuilder('e')
            ->andWhere("e.id = :id")
            ->andWhere("e.utilisateur= :userID")
            ->setParameter('id', $id)
            ->setParameter('userID', $userID)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function updateEmpruntFilmActif(int $idUtilisateur, int $idEmprunt, bool $actif = false, ManagerRegistry $doctrine, EmpruntSerieSaisonRepository $empruntSerieSaisonRepository){
        $em = $doctrine->getManager();
        $empruntSerie = $empruntSerieSaisonRepository->findOneByIDAndUserID($idEmprunt, $idUtilisateur);
        $empruntSerie->setActif($actif);
        $em->flush();
    }
    // /**
    //  * @return EmpruntSerieSaison[] Returns an array of EmpruntSerieSaison objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EmpruntSerieSaison
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
