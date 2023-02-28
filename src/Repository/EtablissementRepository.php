<?php

namespace App\Repository;

use App\Entity\Etablissement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Etablissement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Etablissement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Etablissement[]    findAll()
 * @method Etablissement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EtablissementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Etablissement::class);
    }

    // /**
    //  * @return Etablissement[] Returns an array of Etablissement objects
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
    public function findOneBySomeField($value): ?Etablissement
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    /**
      * @return Etablissement[] Returns an array of Etablissement objects
      */

      public function findByDepartement($value)
      {
          return $this->createQueryBuilder('e')
              ->andWhere('e.departement = :val')
              ->setParameter('val', $value)
              ->orderBy('e.id', 'ASC')
              ->getQuery()
              ->getResult();
      }

    /**
      * @return Etablissement[] Returns an array of Etablissement objects
      */

      public function findByCommune($value)
      {
          return $this->createQueryBuilder('e')
              ->andWhere('e.commune = :val')
              ->setParameter('val', $value)
              ->orderBy('e.id', 'ASC')
              ->getQuery()
              ->getResult();
      }

      /**
        * @return Etablissement[] Returns an array of Etablissement objects
        */

        public function findByRegion($value)
        {
            return $this->createQueryBuilder('e')
                ->andWhere('e.region = :val')
                ->setParameter('val', $value)
                ->orderBy('e.id', 'ASC')
                ->getQuery()
                ->getResult();
        }

        /**
          * @return Etablissement[] Returns an array of Etablissement objects
          */

          public function findByAcademie($value)
          {
              return $this->createQueryBuilder('e')
                  ->andWhere('e.academie = :val')
                  ->setParameter('val', $value)
                  ->orderBy('e.id', 'ASC')
                  ->getQuery()
                  ->getResult();
          }

          /**
            * @return Etablissement[] Returns an array of Etablissement objects
            */

            public function findBySecteur($value)
            {
                return $this->createQueryBuilder('e')
                    ->andWhere('e.secteur = :val')
                    ->setParameter('val', $value)
                    ->orderBy('e.id', 'ASC')
                    ->getQuery()
                    ->getResult();
            }

            /**
              * @return Etablissement[] Returns an array of Etablissement objects
              */

              public function findByNature($value)
              {
                  return $this->createQueryBuilder('e')
                      ->andWhere('e.nature = :val')
                      ->setParameter('val', $value)
                      ->orderBy('e.id', 'ASC')
                      ->getQuery()
                      ->getResult();
              }
}
