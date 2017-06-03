<?php

namespace AppBundle\Service;

use AppBundle\Entity\HappinessLevel;
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

    public function getStatistics(Period $period)
    {
        $levels = $this->getByLevels($period);
        $total = $this->getTotal($levels);
        $score = $this->getHappinessLevel($levels, $total);
        $level = $this->getReadableHappinessLevel($score);

        return [
            'levels' => $levels,
            'total' => $total,
            'happiness' => [
                'score' => $score,
                'level' => $level
            ],
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

    private function getReadableHappinessLevel($result): string
    {
        if ($result >= 75) {
            return HappinessLevel::LEVEL_HAPPY;
        }

        if ($result >= 50) {
            return HappinessLevel::LEVEL_NEUTRAL;
        }

        return HappinessLevel::LEVEL_SAD;
    }

    private function getHappinessLevel(array $levels, int $total): int
    {

        $result = [];
        $expected = $total * 100;

        if ($expected === 0) {
            return 0;
        }

        $result['h'] = $levels[HappinessLevel::LEVEL_HAPPY] * 100;
        $result['n'] = $levels[HappinessLevel::LEVEL_NEUTRAL] * 50;
        $result['s'] = $levels[HappinessLevel::LEVEL_SAD] * 0;

        $total = array_sum(array_values($result));

        return $total / $expected * 100;

    }

    /**
     * @param \DateTime|null $from
     * @param \DateTime|null $to
     * @return Period
     */
    public function getPeriod(\DateTime $from = null, \DateTime $to = null): Period
    {
        if (!$from instanceof \DateTime && !$to instanceof \DateTime) {
            $from = (new \DateTime())->setTime(0, 0, 0);
            $to = (clone $from)->setTime(23, 59, 59);

        } elseif (!$to instanceof \DateTime) {
            $from = $from->setTime(0, 0, 0);
            $to = (new \DateTime())->setTime(23, 59, 59);
        } else {
            $from = $from->setTime(0, 0, 0);
            $to = $to->setTime(23, 59, 59);
        }

        return new Period($from, $to);
    }

}