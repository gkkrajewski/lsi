<?php

namespace App\Repository;

use App\Entity\Report;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Report>
 *
 * @method Report|null find($id, $lockMode = null, $lockVersion = null)
 * @method Report|null findOneBy(array $criteria, array $orderBy = null)
 * @method Report[]    findAll()
 * @method Report[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReportRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Report::class);
    }

    public function add(Report $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Report $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return Report[] Returns an array of Report objects
     */
    public function findBySearchFields(
        string $sortName,
        string $sortDesc,
        \DateTime $from = null,
        \DateTime $to = null,
        string $place = null
    ): array {
        $result = $this->createQueryBuilder('r')
            ->where('1 = 1')
            ->orderBy('r.' . $sortName, $sortDesc);

        if ($from !== null) {
            $result
                ->andWhere('r.date > :from')
                ->setParameter('from', $from);
        }

        if ($to !== null) {
            $result
                ->andWhere('r.date < :to')
                ->setParameter('to', $to);
        }

        if ($place !== null) {
            $result
                ->andWhere('r.placename = :place')
                ->setParameter('place', $place);
        }

        return $result->getQuery()->getResult();
    }
}
