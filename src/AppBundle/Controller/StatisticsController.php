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
     * @Route(
     *     name="happiness_levels_statistics",
     *     path="/happiness_levels/statistics",
     * )
     * @Method("GET")
     */
    public function indexAction()
    {
        $service = $this->get(HappinessLevelStatistics::class);

        return new JsonResponse($service->today());

    }
}
