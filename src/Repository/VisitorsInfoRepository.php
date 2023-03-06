<?php

namespace App\Repository;

use App\Entity\VisitorsInfo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<VisitorsInfo>
 *
 * @method VisitorsInfo|null find($id, $lockMode = null, $lockVersion = null)
 * @method VisitorsInfo|null findOneBy(array $criteria, array $orderBy = null)
 * @method VisitorsInfo[]    findAll()
 * @method VisitorsInfo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VisitorsInfoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VisitorsInfo::class);
    }

    public function save(VisitorsInfo $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(VisitorsInfo $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return VisitorsInfo[] Returns an array of VisitorsInfo objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('v.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?VisitorsInfo
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
