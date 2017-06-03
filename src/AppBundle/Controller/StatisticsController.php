<?php

namespace AppBundle\Controller;

use AppBundle\Service\HappinessLevelStatistics;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class StatisticsController extends Controller
{

    /**
     * @Route(name="happiness_levels_statistics", path="/happiness_levels/statistics")
     * @Route(name="happiness_levels_statistics_period", path="/happiness_levels/statistics/{from}/{to}")
     * @Route(name="happiness_levels_statistics_from", path="/happiness_levels/statistics/{from}")
     * @Method("GET")
     * @param \DateTime $from
     * @param \DateTime $to
     * @return JsonResponse
     */
    public function indexAction(\DateTime $from = null, \DateTime $to = null): JsonResponse
    {
        /** @var HappinessLevelStatistics $service */
        $service = $this->get(HappinessLevelStatistics::class);

        return new JsonResponse($service->getStatistics($service->getPeriod($from, $to)));

    }

}
