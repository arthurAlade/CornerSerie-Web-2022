<?php

namespace App\Repository;

use App\Entity\EmpruntFilm;
use App\Entity\Utilisateur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EmpruntFilm|null find($id, $lockMode = null, $lockVersion = null)
 * @method EmpruntFilm|null findOneBy(array $criteria, array $orderBy = null)
 * @method EmpruntFilm[]    findAll()
 * @method EmpruntFilm[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmpruntFilmRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EmpruntFilm::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(EmpruntFilm $entity, bool $flush = true): void
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
    public function remove(EmpruntFilm $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * Retourne la liste des films empruntés où l'emprunt n'est plus actif
     * @param int $utilisateur
     * @return float|int|mixed|string
     */
    public function findAllPastFromUser(int $utilisateur): mixed
    {
        $utilisateurID = $utilisateur;
        return $this->createQueryBuilder('e')
            ->select('e, film')
            ->join('e.film', 'film')
            ->where('e.actif = 0')
            ->andWhere('e.utilisateur = :utilisateurID')
            ->setParameter('utilisateurID', $utilisateurID)
            ->getQuery()
            ->getResult();
    }

    /**
     * Retourne la liste des films empruntés où l'emprunt est actif
     * @param int $utilisateur
     * @return float|int|mixed|string
     */
    public function findAllCurrentFromUser(int $utilisateur): mixed
    {
        $utilisateurID = $utilisateur;
        return $this->createQueryBuilder('e')
            ->select('e, film')
            ->join('e.film', 'film')
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

    public function updateEmpruntFilmActif(int $idUtilisateur, int $idEmprunt, bool $actif = false, ManagerRegistry $doctrine, EmpruntFilmRepository $empruntFilmRepository){
        $em = $doctrine->getManager();
        $empruntFilm = $empruntFilmRepository->findOneByIDAndUserID($idEmprunt, $idUtilisateur);
        $empruntFilm->setActif($actif);
        $em->flush();
    }

    // /**
    //  * @return EmpruntFilm[] Returns an array of EmpruntFilm objects
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
    public function findOneBySomeField($value): ?EmpruntFilm
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
