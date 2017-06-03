<?php

namespace AppBundle\Service;

use AppBundle\Repository\HappinessLevelRepository;
use AppBundle\ValueObject\Period;
use Doctrine\ORM\EntityRepository;

class HappinessLevelStatistics
{

    /** @var HappinessLevelRepository */
    private $repository;

    /**
     * @param HappinessLevelRepository|EntityRepository $repository
     */
    public function __construct(EntityRepository $repository)
    {
        $this->repository = $repository;
    }

    public function today(): array
    {

        $period = $this->getTodayPeriod();
        $levels = $this->getByLevels($period);
        $total = $this->getTotal($levels);
        $avg = $this->getTodayAvg($levels, $total);

        return [
            'levels' => $levels,
            'total' => $total,
            'avg' => $avg,
            'period' => [
                'from' => $period->getFrom(),
                'to' => $period->getTo(),
            ]
        ];
    }

    private function getByLevels(Period $period): array
    {
        return $this->repository->getTotalByPeriod($period);
    }

    private function getTotal(array $levels): int
    {
        return array_sum(array_values($levels));
    }

    private function getTodayAvg(array $levels, int $total): int
    {
        return 0;

    }

    private function getTodayPeriod(): Period
    {
        $from = (new \DateTime())->setTime(0, 0);
        $to = (clone $from)->setTime(23, 59, 59);

        return new Period($from, $to);
    }

}