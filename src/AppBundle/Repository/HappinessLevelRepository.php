<?php

namespace AppBundle\Repository;

use AppBundle\ValueObject\Period;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping as ORM;

class HappinessLevelRepository extends EntityRepository
{

    public function getTotalByPeriod(Period $period): array
    {
        $query = $this->createQueryBuilder('h', 'h.level')
            ->select('h.level, count(h.id) as total')
            ->where('h.createdAt >= :from')
            ->andWhere('h.createdAt <= :to')
            ->setParameter('from', $period->getFrom())
            ->setParameter('to', $period->getTo())
            ->groupBy('h.level');

        $result = $query->getQuery()->getArrayResult();

        $data = [];
        $data['happy'] = array_key_exists('happy', $result) ? (int)$result['happy']['total'] : 0;
        $data['neutral'] = array_key_exists('neutral', $result) ? (int)$result['neutral']['total'] : 0;
        $data['sad'] = array_key_exists('sad', $result) ? (int)$result['sad']['total'] : 0;

        return $data;
    }

}
